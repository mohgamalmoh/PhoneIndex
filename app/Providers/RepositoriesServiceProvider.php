<?php

namespace App\Providers;


use App\Modules\Customers\Repositories\CustomerRepository;
use App\Modules\Customers\Repositories\EloquentCustomerRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;


class RepositoriesServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
        CustomerRepository::class,
        EloquentCustomerRepository::class
    );
    }

    //deferring the resolving of CustomerRepository until we actually need it
    public function provides()
    {
        return [CustomerRepository::class];
    }
}
