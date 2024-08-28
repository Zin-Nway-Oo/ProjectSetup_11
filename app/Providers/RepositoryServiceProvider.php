<?php

namespace App\Providers;

use App\Repository\EloquentImpl\BaseRepositoryImpl;
use App\Repository\EloquentImpl\UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;
use App\Repository\EloquentRepository;
use App\Repository\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepository::class, BaseRepositoryImpl::class);
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        
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
