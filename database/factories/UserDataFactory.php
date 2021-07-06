<?php

namespace Database\Factories;

use App\Models\UserData;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Package ; 
use Illuminate\Support\Arr;

class UserDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $packagesIds = Package::where('application_id' , 1)->pluck('id')->toArray() ; 

        return [
            'phone' => $this->faker->randomNumber,
            'gender' => $this->faker->boolean(50)  , 
            'birth_date' =>$this->faker->dateTime() ,
            'package_id' =>Arr::random($packagesIds) , 
        ];
    }
}
