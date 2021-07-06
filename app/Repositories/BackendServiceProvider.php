<?php
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            'App\Repositories\PostRepositoryInterface',
            'App\Repositories\PostRepository',
            'App\Repositories\UserDataRepository' , 
            'App\Repositories\CountryRepository' , 
            'App\Repositories\CityRepository' , 
            
        );
    }
}
