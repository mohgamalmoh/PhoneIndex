<?php

namespace App\Providers;


use App\Modules\Countries\Services\CountriesService;
use App\Modules\Countries\Services\Interfaces\CountriesInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;


class ServicesServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
        CountriesInterface::class,
        CountriesService::class
    );
    }

    //deferring the resolving of CountriesInterface until we actually need it
    public function provides()
    {
        return [CountriesInterface::class];
    }
}
