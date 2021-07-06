<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment_method ;
class Payment_methodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment_method::create([
            'name' => 'visa',

        ]);
        Payment_method::create([
            'name' => 'aman',

        ]);
        Payment_method::create([
            'name' => 'fawry',

        ]);
    }
}
