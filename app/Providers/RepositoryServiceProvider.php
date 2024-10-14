<?php

namespace App\Providers;

use App\Repository\Impl\VaccineRepoImpl;
use App\Repository\VaccineRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    // Register bindings, interface => class
    public array $bindings = [
        VaccineRepo::class => VaccineRepoImpl::class
    ];

}
