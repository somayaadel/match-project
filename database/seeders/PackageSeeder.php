<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package ;
use App\Models\Feature ;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uploadVideo = Feature::create([
            'name' => 'upload video',
            'name_ar' => 'تحميل فيديو',
            'service_id' => '1'
        ]);


        $uploadPhoto = Feature::create([
            'name' => 'upload photo',
            'name_ar' => 'تحميل صورة ',
            'service_id' => '2'
        ]);

        $free = Package::create([
            'name' => 'free',
            'name_ar' => 'مجانية',
            'price' => '0',
            'logo' => '' , 
            'application_id' => '1' ,
            'duration' => '5',
            'role_id' => '3' ,
        ]);

        Package::create([
            'name' => 'package',
            'name_ar' => 'باكدج',
            'price' => '55',
            'logo' => 'fgff',
            'application_id' => '1' ,
            'duration' => '5',
            'role_id' => '2' ,
        ]);

        $gold = Package::create([
            'name' => 'gold',
            'name_ar' => 'ذهبية',
            'price' => '55',
            'logo'=>'/images/seeders/gold.png' , 
            'application_id' => '2' ,
            'duration' => '5',
            'role_id' => '3' ,
        ]);


        $bronze = Package::create([
            'name' => 'Bronz',
            'name_ar' => 'برونز',
            'price' => '55',
            'logo' => '/images/seeders/bronze.png' , 
            'application_id' => '2' ,
            'duration' => '5',
            'role_id' => '3' ,
        ]);

        


        $gold->features()->attach([ ['package_id'=>$gold->id , 'feature_id'=>$uploadPhoto->id , 'limitation' => 4 ] ,['package_id'=>$gold->id , 'feature_id'=>$uploadVideo->id , 'limitation' => 6 ]  ]) ; 

    }
}
