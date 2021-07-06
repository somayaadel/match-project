<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::create([
            'name' => 'add User ',
            'router' => 'addUser'
        ]);
        Permission::create([
            'name' => 'Free Users',
            'router' => 'freeUserList'
        ]);
        Permission::create([
            'name' => 'premium Users',
            'router' => 'premiumUserList'
        ]);
        Permission::create([
            'name' => 'deleted Users',
            'router' => 'deletedUserList'
        ]);
        Permission::create([
            'name' => 'blocked Users',
            'router' => 'blockedUsers'
        ]);
        Permission::create([
            'name' => ' staff List',
            'router' => 'staffList'
        ]);
        Permission::create([
            'name' => ' add Staff',
            'router' => 'addStaff'
        ]);
        Permission::create([
            'name' => ' add staff permission',
            'router' => 'roles'
        ]);
        Permission::create([
            'name' => ' package List',
            'router' => 'packageList'
        ]);
        Permission::create([
            'name' => ' edit package',
            'router' => 'editpackage'
        ]);
        Permission::create([
            'name' => ' add Package',
            'router' => 'addPackage'
        ]);
        Permission::create([
            'name' => ' category List',
            'router' => 'categoryList'
        ]);
        Permission::create([
            'name' => ' add Category',
            'router' => 'addCategory'
        ]);
        Permission::create([
            'name' => ' editCategory',
            'router' => 'editCategory'
        ]);
        Permission::create([
            'name' => ' earning List',
            'router' => 'earningList'
        ]);
        Permission::create([
            'name' => ' application List',
            'router' => 'applicationList'
        ]);
        Permission::create([
            'name' => 'application Settings',
            'router' => 'applicationSettings'
        ]);
        Permission::create([
            'name' => 'emailList',
            'router' => 'emailList'
        ]);
        Permission::create([
            'name' => 'send Email',
            'router' => 'sendEmail'
        ]);
        Permission::create([
            'name' => 'contact Message List',
            'router' => 'contactMessageList'
        ]);
        Permission::create([
            'name' => 'field List',
            'router' => 'fieldList'
        ]);
        Permission::create([
            'name' => 'add Field',
            'router' => 'addField'
        ]);
        Permission::create([
            'name' => 'add Category Type',
            'router' => 'addCategoryType'
        ]);
        Permission::create([
            'name' => 'category Type List',
            'router' => 'categoryTypeList'
        ]);
        Permission::create([
            'name' => 'company List',
            'router' => 'companyList'
        ]);
        Permission::create([
            'name' => 'send SMS',
            'router' => 'sendSMS'
        ]);
        Permission::create([
            'name' => 'import Category',
            'router' => 'importCateg'
        ]);
    }
}
