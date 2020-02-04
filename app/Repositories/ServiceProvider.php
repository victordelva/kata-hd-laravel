<?php


namespace App\Repositories;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function register()
    {
        $this->app->bind(
            EmployeesRepositoryContract::class,
            EmployeesRepository::class
        );
    }
}
