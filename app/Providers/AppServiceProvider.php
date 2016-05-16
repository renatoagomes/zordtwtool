<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ConstantsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConstantsRepository::class, function ($app) {
            return new ConstantsRepository();
        });
    }
}
