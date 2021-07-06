<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category ;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'science fiction',
            'name_ar' => 'خيال علمي' ,
            'category_type_id' => '1' ,
            'application_id' => '2' ,
        ]);
        Category::create([
            'name' => 'action',
            'name_ar' => 'اكشن' ,
            'category_type_id' => '1' ,
            'application_id' => '2' ,
        ]);
        Category::create([
            'name' => 'drama',
            'name_ar' => 'دراما' ,
            'category_type_id' => '1' ,
            'application_id' => '2' ,
        ]);
        Category::create([
            'name' => 'comedy',
            'name_ar' => 'كوميدى' ,
            'category_type_id' => '1' ,
            'application_id' => '2' ,
        ]);

        Category::create([
            'name' => 'ahmed ezz',
            'name_ar' => 'احمد عز' ,
            'image' => '/images/seeders/actors/ezz.jpg',
            'category_type_id' => '2' ,
            'application_id' => '2' ,
        ]);
        Category::create([
            'name' => 'ahmed elsaka',
            'name_ar' => 'احمد السقا' ,
            'image' => '/images/seeders/actors/sa2a.jpg',

            'category_type_id' => '2' ,
            'application_id' => '2' ,
        ]);
        Category::create([
            'name' => 'mohamed helmy',
            'name_ar' => 'محمد هنيدى' ,
            'image' => '/images/seeders/actors/henedy.jpg',

            'category_type_id' => '2' ,
            'application_id' => '2' ,
        ]);
        Category::create([
            'name' => 'mona zaki',
            'name_ar' => 'منى زكى' ,
            'image' => '/images/seeders/actors/mona.jpg',

            'category_type_id' => '2' ,
            'application_id' => '2' ,
        ]);
        Category::create([
            'name' => 'yasmin abd elaziz',
            'name_ar' => ' ياسمسن عيد العزيز' ,
            'image' => '/images/seeders/actors/yassmin.jpg',
            'category_type_id' => '2' ,
            'application_id' => '2' ,
        ]);
    }
}
