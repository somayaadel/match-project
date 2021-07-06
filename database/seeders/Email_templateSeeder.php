<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\EmailTemplate;

class Email_templateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        EmailTemplate::create([
            'type' => 'password reset',
            'subject' => 'reset your password ',
            'body' => 'reset your password reset your password reset your password'

        ]);
        EmailTemplate::create([
            'type' => 'package purchase email',
            'subject' => 'package purchase email',
            'body' => 'package purchase email package purchase email package purchase email package purchase email'

        ]);
        EmailTemplate::create([
            'type' => 'email verification',
            'subject' => 'email verification ',
            'body' => 'email verificationemail verificationemail verificationemail verification'

        ]);

    }
}
