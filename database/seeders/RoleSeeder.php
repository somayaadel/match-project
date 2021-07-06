<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'name_ar' => 'مسؤول',
        ]);
        Role::create([
            'name' => 'company',
            'name_ar' => 'شركة',
        ]);
        Role::create([
            'name' => 'talanted',
            'name_ar' => 'موهوب',
        ]);
        Role::create([
            'name' => 'staff',
            'name_ar' => 'مدير الموقع',
        ]);
    }
}
