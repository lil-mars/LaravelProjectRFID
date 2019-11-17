<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
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
        setLocale(LC_TIME, 'es_BO.utf8');
        Carbon::setLocale('es_BO.utf8');
        Carbon::setUtf8(false);
    }
}
