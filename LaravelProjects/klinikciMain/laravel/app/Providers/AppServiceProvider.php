<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
 
    /**
     * Register any application services.
     *
     * @return void
     */  
    public function register()
    {
        // var_dump();
        // var_dump();
        $this -> app -> bind('path.public', function() { return $_SERVER['DOCUMENT_ROOT']; });
    }
}
