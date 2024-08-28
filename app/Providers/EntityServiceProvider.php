<?php

namespace App\Providers;

use App\Service\ServiceImpl\UserServiceImpl;
use App\Service\UserService;
use Illuminate\Support\ServiceProvider;


class EntityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {        
        $this->app->bind(UserService::class, UserServiceImpl::class);
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
