<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field ; 
class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::create([
            'name' => 'home address' ,
            'role_id' => '3' , 
            'name_ar' => 'العنوان الاصلي',
            'type' => 'string' , 
            'application_id' => 1 , 
        ]); 

        Field::create([
            'name' => 'life style' ,
            'role_id' => '3' , 
            'name_ar' => 'لايف استايل',
            'type' => 'string' , 
            'application_id' => 1 , 
        ]); 

        Field::create([
            'name' => 'permanent address' ,
            'role_id' => '3' , 
            'name_ar' => 'العنوان المؤقت',
            'type' => 'string' , 
            'application_id' => 1 , 
        ]); 

        Field::create([
            'name' => 'additional personal details' ,
            'role_id' => '3' , 
            'name_ar' => 'معلومات اضافية',
            'type' => 'string' , 
            'application_id' => 1 , 
        ]); 
        Field::create([
            'name' => 'hobbies and interests' ,
            'role_id' => '3' , 
            'required' => '1' , 
            'name_ar' => 'الهوايات و الاهتمامات',
            'type' => 'string' , 
            'application_id' => 1 , 
        ]); 


        Field::create([
            'name' => 'favourite food' ,
            'role_id' => '3' , 
            'required' => '1' , 
            'name_ar' => 'الطعام المفضل',
            'type' => 'multi-select' , 
            'items' => [ ['name'=>'apple' , 'name_ar'=>'تفاحة'] , ['name'=>'bannana' , 'name_ar'=>'موزة'] ] , 
            'application_id' => 1 , 
        ]); 




        Field::create([
            'name' => 'voice' ,
            'role_id' => '3' , 
            'required' => '1' , 
            'name_ar' => 'الصوت',
            'type' => 'number' , 
            'application_id' => 2 , 
        ]); 


        Field::create([
            'name' => 'width' ,
            'role_id' => '3' , 
            'required' => '1' , 
            'name_ar' => 'العرض',
            'type' => 'number' , 
            'application_id' => 2 , 
        ]); 

        Field::create([
            'name' => 'practice_sports' ,
            'role_id' => '3' , 
            'required' => '1' , 
            'name_ar' => 'هل تمارس الرياضة',
            'type' => 'select' , 
            'items' => [ ['name'=>'yes' , 'name_ar'=>'نعم'] , ['name'=>'no' , 'name_ar'=>'لا'] ] , 
            'application_id' => 2 , 
        ]); 

    }
}
