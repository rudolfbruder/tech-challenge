<?php

namespace App\Providers;

use App\Domain\Clients\Repositories\ClientRepositoryInterface;
use App\Domain\Clients\Repositories\EloquentClientRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClientRepositoryInterface::class, function () {
            if (config('services.client_repository') == 'eloquent') {

                return new EloquentClientRepository();
            }

            //we could use another repository like elastic search for example
            return new EloquentClientRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
