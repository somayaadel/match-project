<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserData;
use App\Models\Package;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'name_ar' => 'مسؤول جدا',
            'email' => 'admin@match.com',
            'password' => Hash::make('123456'),
            'role_id' => '1' ,
            'application_id'=> '1',
            'user_code'=> 'ldk4545' ,

        ]);

        UserData::create([
            'user_id' => $admin->id ,
            'phone' => '010106522765' ,
            'gender' => 0 ,
            'birth_date' => '1988-10-04' ,
            'profile_image' => '/images/seeders/d9569bbed4393e2ceb1af7ba64fdf86a.jpg'
        ]);
        
        $company =User::create([
            'name' => 'company',
            'name_ar' => 'شركة',
            'email' => 'company@match.com',
            'password' => Hash::make('123456'),
            'role_id' => '2',
            'application_id'=> '1',
            'user_code'=> 'ldk4545'

        ]);

        UserData::create([
            'user_id' => $company->id , 
            'phone' => '010106522765' , 
            'gender' => 0 , 
            'birth_date' => '1988-10-04' , 
            'profile_image' => '/images/seeders/d9569bbed4393e2ceb1af7ba64fdf86a.jpg'

        ]);

        $talanted = User::create([
            'name' => 'talanted',
            'name_ar' => 'موهوب جدا',
            'email' => 'talanted@match.com',
            'password' => Hash::make('123456'),
            'role_id' => '3' ,
            'application_id'=> '2',
            'user_code'=> 'ldk4545'
        ]);

        UserData::create([
            'user_id' => $talanted->id , 
            'phone' => '010106522765' , 
            'gender' => 0 , 
            'birth_date' => '1988-10-04' , 
            'profile_image' => '/images/seeders/d9569bbed4393e2ceb1af7ba64fdf86a.jpg'
        ]);

        
        $staff = User::create([
            'name' => 'staff',
            'name_ar' => 'مسؤول جدا',
            'email' => 'staff@match.com',
            'password' => Hash::make('123456'),
            'role_id' => '1' ,
            'application_id'=> '1',
            'user_code'=> 'ldk4545' ,

        ]);

        UserData::create([
            'user_id' => $staff->id ,
            'phone' => '010106522765' ,
            'gender' => 0 ,
            'birth_date' => '1988-10-04' ,
            'profile_image' => '/images/seeders/d9569bbed4393e2ceb1af7ba64fdf86a.jpg'
        ]);
        

        $users = User::factory()->count(57)
           ->create()
           ->each(function ($user) {
                $user->userData()->save(UserData::factory()->make());
            })->each(function($user){
                $pacakgeStartDate = Carbon::now() ; 
                $package = Package::where('id' , $user->userData->package_id)->first() ; 
                $user->allPackages()->attach($user->userData->package_id ,[
                    'start_date' => $pacakgeStartDate->toDateTimeString() ,
                    'end_date' => $pacakgeStartDate->addDays($package->duration)->toDateTimeString()   ,
                    'created_at' =>Carbon::now() ,
                    'updated_at' =>Carbon::now() , 
                ]);
            });
    }
}
