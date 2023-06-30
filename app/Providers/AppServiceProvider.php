<?php

namespace App\Providers;

use App\Drives\ElasticDrive;
use Core\Category\Infra\Contracts\ElasticClientInterface;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->singleton(Client::class, function () {
        //     return ClientBuilder::create()
        //         ->setHosts(config('elasticsearch.hosts'))
        //         ->setBasicAuthentication(
        //             config('elasticsearch.authentication.username'),
        //             config('elasticsearch.authentication.password'),
        //         )->build();
        // });
        $this->app->singleton(
            ElasticClientInterface::class,
            ElasticDrive::class,
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
