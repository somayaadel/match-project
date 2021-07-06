<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ApplicationSeeder::class);
        $this->call(CategoryTypeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(Payment_methodSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(FieldSeeder::class);
        $this->call(Email_templateSeeder::class);

    }
}
