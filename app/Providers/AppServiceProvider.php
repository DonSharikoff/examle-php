<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use jcobhams\NewsApi\NewsApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            NewsApi::class,
            function () {
                return new NewsApi(config('news-api.api_key'));
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
