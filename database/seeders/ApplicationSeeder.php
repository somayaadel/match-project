<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneralSetting;

use App\Models\Application ;
class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app1=Application::create([
            'name' => 'app 1',
            'application_key' => 'secret' ,
            'name_ar' => 'تطبيق 1'
        ]);
        GeneralSetting::create([
            'email' => '',
            'phone' => ' ',
            'time_zone' => ' ',
            'member_email_verification' => '1',
            'member_profile_picture_admin_approve' => '0 ',
            'terms' => '',
            'privacy_policy' => '',
            'application_id' => $app1->id,
        ]);

       $incadre = Application::create([
            'name' => 'Incadre',
            'application_key' => '$2y$10$8IAbO4GqcjwWfHncXHmGVu8SvZm.6HBdEuPG38VcWbMB.csTO1lQa' ,
            'logo'=>'/images/seeders/incadreLogo.svg' ,
            'name_ar' => 'كادر'
        ]);
        GeneralSetting::create([
            'email' => '',
            'phone' => ' ',
            'time_zone' => ' ',
            'member_email_verification' => '1',
            'member_profile_picture_admin_approve' => '0 ',
            'terms' => '',
            'privacy_policy' => '',
            'application_id' => $incadre->id,
        ]);

    }
}
