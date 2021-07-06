<?php

namespace App\Http\Controllers;

use App\Helpers\Notification as MyNotifications;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function addTokenNotification(Request $request)
    {
        $validation = $request->validate([
            'fcm_token' => 'required',
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        if (!$user) {
            return response()->json([
                'status' => "failed",
                'message' => "you have to provide a valid access token",
            ]);
        }
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return response()->json([
            'status' => "success",
            'message' => "firebase notification token saved successfully",
        ]);
    }

    public function testFcm(Request $request)
    {
        $notificationTest = new MyNotifications();
        $notificationTests = Notification::where('id', 1)->first();
        $NotificationResult = $notificationTest->sendFcmMessage($notificationTests);
        if ($NotificationResult) {
            $notificationTest->saveUserNotification(1);
        }

        return $NotificationResult;
    }
    public function sendNotifications()
    {
        if (!auth()->user()) {
            return response()->json(['status' => "you have to provide a valid access token"]);
        }
        $user = User::where('id', auth()->user()->id)->first();
        $notifications = $user->notifications()->where('seen', '!=', 'true')->limit(20)->get();

        foreach ($notifications as $notification) {
            $notification->pivot->seen = 'sent';
            DB::update(
                'update notification_user set seen = "sent" where id = ?',
                [$notification->pivot->id]
            );
        }
        return response()->json([
            'status' => "success",
            'notificationsCount' => $notifications->count(),
        ]);
    }
    public function sendAllNotifications()
    {
        if (!auth()->user()) {
            return response()->json(['status' => "you have to provide a valid access token"]);
        }
        $user = User::where('id', auth()->user()->id)->first();
        $notifications = $user->notifications()->limit(20)->get();

        foreach ($notifications as $notification) {
            // $notification->pivot->seen='sent';
            // DB::update(
            //     'update notification_user set seen = "sent" where id = ?',
            //     [$notification->pivot->id]
            // );
            Carbon::setlocale("en");
            $notification->time = Carbon::parse($notification->pivot->created_at)->diffForHumans();
            Carbon::setlocale("ar");
            $notification->ar_time = Carbon::parse($notification->pivot->created_at)->diffForHumans();
        }
        return response()->json([
            'status' => "success",
            'notifications' => $notifications,
        ]);
    }
    public function sendNewNotifications()
    {
        if (!auth()->user()) {
            return response()->json(['status' => "you have to provide a valid access token"]);
        }
        $user = User::where('id', auth()->user()->id)->first();
        $notifications = $user->notifications()->where('seen', 'false')->limit(20)->get();

        foreach ($notifications as $notification) {
            Carbon::setlocale("en");
            $notification->ar_time = Carbon::parse($notification->pivot->created_at)->diffForHumans(null, true);
            $notification->time = Carbon::parse($notification->pivot->created_at)->diffForHumans(null, true);
            Carbon::setlocale("ar");
            $notification->ar_time = Carbon::parse($notification->pivot->created_at)->diffForHumans(null, true);
            $notification->pivot->seen = 'sent';
            DB::update(
                'update notification_user set seen = "sent" where id = ?',
                [$notification->pivot->id]
            );
        }
        return response()->json([
            'status' => "success",
            'notifications' => $notifications,
        ]);
    }
    public function seenNotifications()
    {
        if (!auth()->user()) {
            return response()->json(['status' => "you have to provide a valid access token"]);
        }
        $user = User::where('id', auth()->user()->id)->first();
        $notifications = $user->notifications()->where('seen', 'sent')->limit(20)->get();
        foreach ($notifications as $notification) {
            $notification->pivot->seen = 'sent';
            DB::update(
                'update notification_user set seen = "true" where id = ?',
                [$notification->pivot->id]
            );
        }
        return response()->json([
            'status' => "success",
        ]);
    }
}
