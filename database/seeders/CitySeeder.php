<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City ;
use App\Models\Country ;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $egypt = Country::create([
            'name' => 'Egypt' ,
            'name_ar' => 'مصر' 
        ]); 

        City::create([
            'name' => 'Naser City' ,
            'name_ar' => 'مدينة نصر' , 
            'country_id' => $egypt->id , 
        ]); 

        City::create([
            'name' => 'New Cairo' ,
            'name_ar' => 'مصر الجديدة' , 
            'country_id' => $egypt->id , 
        ]); 

        $soudan = Country::create([
            'name' => 'Soudan' ,
            'name_ar' => 'السودان' 
        ]); 

        City::create([
            'name' => 'Khartoum' ,
            'name_ar' => 'الخرطوم' , 
            'country_id' => $soudan->id , 
        ]); 
    }
}
