<?php

namespace App\Providers;

use App\Enquirer;
use App\Observers\EnquirerObserver;
use App\Observers\PersonObserver;
use App\Person;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Person::observe(PersonObserver::class);
        Enquirer::observe(EnquirerObserver::class);
    }
}
