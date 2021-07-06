<?php
namespace App\Http\Controllers;

use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Requests\Auth\SocialRequest;
use App\Models\Role;
use App\Models\SmsConfiguration;
use App\Models\User;
use App\Models\UserData;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use DB;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */

    public function checkPhoneConfirmationCode(Request $request)
    {

        if (!auth()->user()) {
            return response()->json(['status' => "you have to provide a valid access token"]);

        }
        $user_id = $request->user()->id;
        $code = $request->code;
        $user = UserData::where('user_id', $user_id)->first();

        $status = "wrong code";
        if ($user->phone_confirmed) {
            return response()->json(['status' => 'already confirmed']);
        }
        if ($user->phone_confirmation_code == $code) {
            $user->phone_confirmed = true;
            $user->save();
            $status = 'user phone ' . $user->phone . ' has been confirmed';
        }
        return response()->json(['status' => $status]);
    }
    public function sendCodeToUserPhone(Request $request)
    {
        // dd($request->user());
        // return $request->header('Authorization') ;
        // return response()->json(['status' => $request->header('Authorization')]);
        if (!$request->user()) {
            return response()->json(['status' => "you have to provide a valid access token"]);
        }

        $user_id = auth()->user()->id;
        $user = UserData::where('user_id', $user_id)->first();
        $status = "";
        if ($user->phone_confirmed) {
            $status = 'user phone has phone number ' . $user->phone . ' and its already confirmed';
            return response()->json(['status' => $status]);

        }
        $phone = $request->phone;
        if (!$phone) {
            return response()->json(['status' => "you have to provide a phone "]);
        }
        $user->phone = $phone;
        $code = "";
        for ($i = 0; $i < 6; $i++) {
            $code = $code . rand(0, 9);
        }
        $user->phone_confirmation_code = $code;
        $user->save();

        if (!$request->session()->has('send_attempts')) {
            $request->session()->put('send_attempts', 1);
            $request->session()->put('last_send_time', Carbon::now());
            $status = SmsConfiguration::send("confirmation code : " . $code, $phone, "I Friends", "9u89oJ9a0u", "Dars");
            return response()->json(['status' => $status]);
        }

        $attempts = $request->session()->get('send_attempts');
        if ($attempts >= 40) {
            $value = $request->session()->get('last_send_time');
            if (Carbon::parse() > ($value->addHour(1))) {
                $request->session()->put('send_attempts', 1);
                $request->session()->put('last_send_time', Carbon::now());
                $status = SmsConfiguration::send("confirmation code : " . $code, $phone, "I Friends", "9u89oJ9a0u", "Dars");
                return response()->json(['status' => $status]);
            } else {
                return response()->json(['status' => "you will have three attempts after one hour of the last attempt"]);

            }
        }
        $request->session()->put('send_attempts', $attempts + 1);
        $request->session()->put('last_send_time', Carbon::now());
        $status = SmsConfiguration::send("confirmation code : " . $code, $phone, "I Friends", "9u89oJ9a0u", "Dars");

        return response()->json(['status' => $status]);
    }

    public function socialLogin(SocialRequest $request)
    {

        try {
            if ($request->provider == 'apple') {
                $user_email = $request->email ?: "{$request->id}@{$request->provider}.com";
                $user = User::where('email', $user_email)->first();
                if (!$user) {
                    $user = new User([
                        'name' => $request->name,
                        'email' => $user_email,
                        'password' => null,
                        'role_id' => $request->role_id,
                        'application_id' => $request->application_id,
                        'user_code' => 'code',
                        'name_ar' => $request->name,

                    ]);
                    $user->save();
                    $user->user_code = $this->quickRandom(5, $request->application_id, $user->id);
                    $user->save();
                    $userData = new UserData([
                        'phone' => null,
                        'gender' => '0',
                        'height' => '0',
                        'weight' => '0',
                        'birth_date' => '2020/1/1',
                        'user_id' => $user->id,
                    ]);
                    $userData->save();

                }

            } else {
                $providerUser = Socialite::driver($request->provider)->userFromToken($request->accessToken);
                // $providerUser=Socialite::driver('facebook')->stateless()->userFromToken($token);
                if ($providerUser) {
                    // User email may not provided.
                    $user_email = $providerUser->email ?: "{$providerUser->id}@{$request->provider}.com";

                    // Check to see if there is a user with this email first.
                    $user = User::where('email', $user_email)->first();
                    if (!$user) {
                        $user = new User([
                            'name' => $providerUser->getName(),
                            'email' => $user_email,
                            'password' => null,
                            'role_id' => $request->role_id,
                            'application_id' => $request->application_id,
                            'user_code' => 'code',
                            'name_ar' => $providerUser->getName(),

                        ]);
                        $user->save();
                        $user->user_code = $this->quickRandom(5, $request->application_id, $user->id);
                        $user->save();
                        $userData = new UserData([
                            'phone' => null,
                            'gender' => '0',
                            'height' => '0',
                            'weight' => '0',
                            'birth_date' => '2020/1/1',
                            'user_id' => $user->id,
                        ]);
                        $userData->save();

                    }
                }

                // Return the user object
                $user = User::where('id', $user->id)->with('userData')->first();
                $interests = $user->categories(1)->get();
                $actor_matching = $user->categories(2)->get();
                $user['phone_confirmed'] = $user->userData->phone_confirmed;
                $user['interests'] = $interests;
                $user['actor_matching'] = $actor_matching;
                $user['userRole'] = $user->role->name;
                $user['user_data'] = $user->userData;
                $user['permissions'] = $user->permissions;
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                if ($request->remember_me) {
                    $token->expires_at = Carbon::now()->addWeeks(1);
                }
                $token->save();

                return response()->json([
                    'user' => $user,
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString(),
                ], 200);
            }
        } catch (Exception $exception) {
            return $exception;
        }

    }
    public function signup(SignUpRequest $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'application_id' => $request->application_id,
            'user_code' => 'code',
        ]);
        $user['name_ar'] = $request->name;
        $user->save();
        $user->user_code = $this->quickRandom(5, $request->application_id, $user->id);
        $user->save();

        $userData = new UserData([
            'phone' => ($request->phone) ? $request->phone : null,
            'gender' => '0',
            'height' => '0',
            'weight' => '0',
            'birth_date' => '2020/1/1',
            'user_id' => $user->id,
        ]);
        $userData->save();
        $user->user_data = $userData;
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        $user = User::where('id', $user->id)->with('userData')->first();
        return response()->json([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ], 200);
    }
    public function create()
    {
        $roles = Role::all();
        return response()->json([
            'data' => $roles,
        ], 200);
    }
    private function quickRandom($length = 5, $app_id, $user_id)
    {

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
        $code = $app_id . $user_id . $randomString;
        return $code;
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        // return 'AuthController@login' ;
        $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|max:100',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = $request->user();
        $interests = $user->categories(1)->get();
        $actor_matching = $user->categories(2)->get();
        $user['phone_confirmed'] = $user->userData->phone_confirmed;
        $user['interests'] = $interests;
        $user['actor_matching'] = $actor_matching;
        $user['userRole'] = $user->role->name;
        $user['user_data'] = $user->userData;
        $user['permissions'] = $user->permissions;

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return response()->json([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        // return $request ;
        return response()->json($request->user());
    }

    public function redirect($provider)
    {

        return Socialite::driver($provider)->redirect();

    }

    public function callback($provider)
    {

        $getInfo = Socialite::driver($provider)->user();

        $user = $this->createUser($getInfo, $provider);
        return $user;

        auth()->login($user);

    }
    public function createUser($getInfo, $provider)
    {

        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
            ]);
        }
        return $user;
    }
    public function redirectToForm($token)
    {

        // return redirect()->away('https://matching.reaya.xyz/pages/reset-password/token?token='.$token);
        return redirect()->away('https://matching.reaya.xyz/pages/login');

    }
    public function resetPassword(Request $request)
    {

        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();

        if ($tokenData->email == $request->email) {

            $userInfo = User::where('email', $request->email)->first();
            $userInfo->password = bcrypt($request->password);
            $ususerInfoer->save();
            return response()->json(['status'=>'true','msg' => "Your password updated succefully"]);

        }
        else {
            return response()->json(['status'=>'false','msg' => "Your Email is Wrong"]);
        }

    }
    public function sendResetMail(Request $request)
    {

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now(),
        ]);
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();
        \Mail::to($request->email)->send(new \App\Mail\MyTestMail($tokenData->token));
        return response()->json([
            'message' => 'Mail sent Successfully',
        ]);
        
    }
}
