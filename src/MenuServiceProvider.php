<?php

namespace Tir\Menu;


use Tir\User\Middlewares\IsAdmin;
use Illuminate\Support\ServiceProvider;
use Tir\User\Console\UserMigrateCommand;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Tir\User\Middlewares\IsGuest;
use Tir\User\Middlewares\IsUser;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/Routes/admin.php');

//
//        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');
//
//        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'user');
//
//        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'user');

    }
}
