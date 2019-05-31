<?php

namespace App\Providers;

use App\Models\Kategori;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('pages.components.sidebar', function($view) {
            $kategoriler = Kategori::all();
            // $haberler = Haber::limit(8)->get();
            $view->with('kategoriler', $kategoriler);
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
