<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Page;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //MENU

        $frontMenu = [
            '/'=>'Home',
        ];
        $pages = Page::all();
        foreach($pages as $page) {
            $frontMenu[ $page['slug'] ] = $page['title'];
        }
        View::share('front_menu', $frontMenu);

        //CONFIGURAÇÕES
        $config = [];
        $settings = Setting::all();
        foreach($settings as $setting) {
            $config[ $setting['name'] ] = $setting['content'];
        }
        view::share('front_config', $config);
    }
    
}
