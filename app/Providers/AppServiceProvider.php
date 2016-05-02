<?php

namespace App\Providers;

use App\Tintuc;
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
        view()->composer('partials.hot_post', function($view){

            $view->with('hot_post', Tintuc::latest('updated_at')->where('status', true)->where('hot', true)->first());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
