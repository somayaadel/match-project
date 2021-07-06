<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryType ; 
class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CategoryType::create([
            'name' => 'interests',
            'name_ar' => 'الاهتمامات' ,  
            'application_id' => '2' ,
        ]);
        
        CategoryType::create([
            'name' => 'actor matching',
            'name_ar' => 'شبة مين من الممثلين' ,  
            'application_id' => '2' ,
        ]);

        
    }
}
