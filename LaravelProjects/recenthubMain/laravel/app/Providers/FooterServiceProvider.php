<?php

namespace App\Providers;

use App\Models\Haber;
use App\Models\Kategori;
use Illuminate\Support\ServiceProvider;

class FooterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.components.footer', function($view) {
            $kategoriler = Kategori::all();
            $haberler = Haber::limit(8)->get();
            $view->with('kategoriler', $kategoriler)->with('haberler',$haberler);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
