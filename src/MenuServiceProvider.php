<?php

namespace Tir\Menu;


use Illuminate\Support\ServiceProvider;


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
        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'menu');
        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'menu');

       $this->adminMenu();

    }

    private function adminMenu()
    {
        $menu = resolve('AdminMenu');
        $menu->item('system')->title('menu::panel.system')->link('#')->add();
        $menu->item('system.menu')->title('menu::panel.menu')->link('#')->add();
        $menu->item('system.menu.menus')->title('menu::panel.menus')->route('menu.index')->add();
        $menu->item('system.menu.items')->title('menu::panel.items')->route('menuItem.index')->add();

    }
}
