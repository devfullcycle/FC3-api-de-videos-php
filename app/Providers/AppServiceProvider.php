<?php

namespace App\Providers;

use App\Drivers\ElasticDrive;
use Core\CastMember\Domain\Repository\CastMemberRepositoryInterface;
use Core\CastMember\Infra\CastMemberRepository;
use Core\Category\Domain\Repository\CategoryRepositoryInterface;
use Core\Category\Infra\CategoryRepository;
use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Core\Genre\Domain\Repository\GenreRepositoryInterface;
use Core\Genre\Infra\GenreRepository;
use Core\Video\Domain\Repository\VideoRepositoryInterface;
use Core\Video\Infra\VideoRepository;
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

        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->singleton(
            GenreRepositoryInterface::class,
            GenreRepository::class
        );

        $this->app->singleton(
            CastMemberRepositoryInterface::class,
            CastMemberRepository::class
        );

        $this->app->singleton(
            VideoRepositoryInterface::class,
            VideoRepository::class
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
