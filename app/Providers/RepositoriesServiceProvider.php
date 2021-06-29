<?php

namespace App\Providers;


use App\Modules\Customers\Repositories\CustomerRepository;
use App\Modules\Customers\Repositories\EloquentCustomerRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class RepositoriesServiceProvider extends ServiceProvider
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
}
