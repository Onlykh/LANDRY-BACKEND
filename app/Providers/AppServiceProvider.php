<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Services\UserServices\UserServiceInterface;
use \App\Services\UserServices\UserService;
use \App\Repositories\UserRepositories\UserRepository;
use \App\Repositories\UserRepositories\UserRepositoryInterface;
use \App\Services\VersionServices\VersionServiceInterface;
use \App\Services\VersionServices\VersionService;
use \App\Repositories\VersionRepositories\VersionRepository;
use \App\Repositories\VersionRepositories\VersionRepositoryInterface;
use \App\Services\SliderServices\SliderServiceInterface;
use \App\Services\SliderServices\SliderService;
use \App\Repositories\SliderRepositories\SliderRepository;
use \App\Repositories\SliderRepositories\SliderRepositoryInterface;
use \App\Services\PreferenceServices\PreferenceServiceInterface;
use \App\Services\PreferenceServices\PreferenceService;
use \App\Repositories\PreferenceRepositories\PreferenceRepository;
use \App\Repositories\PreferenceRepositories\PreferenceRepositoryInterface;
use \App\Services\UnitServices\UnitServiceInterface;
use \App\Services\UnitServices\UnitService;
use \App\Repositories\UnitRepositories\UnitRepository;
use \App\Repositories\UnitRepositories\UnitRepositoryInterface;
use \App\Services\OrderLineServices\OrderLineServiceInterface;
use \App\Services\OrderLineServices\OrderLineService;
use \App\Repositories\OrderLineRepositories\OrderLineRepository;
use \App\Repositories\OrderLineRepositories\OrderLineRepositoryInterface;
use \App\Services\OrderHeaderServices\OrderHeaderServiceInterface;
use \App\Services\OrderHeaderServices\OrderHeaderService;
use \App\Repositories\OrderHeaderRepositories\OrderHeaderRepository;
use \App\Repositories\OrderHeaderRepositories\OrderHeaderRepositoryInterface;
use \App\Services\ArticleServices\ArticleServiceInterface;
use \App\Services\ArticleServices\ArticleService;
use \App\Repositories\ArticleRepositories\ArticleRepository;
use \App\Repositories\ArticleRepositories\ArticleRepositoryInterface;
use \App\Services\CategoryServices\CategoryServiceInterface;
use \App\Services\CategoryServices\CategoryService;
use \App\Repositories\CategoryRepositories\CategoryRepository;
use \App\Repositories\CategoryRepositories\CategoryRepositoryInterface;
use \App\Services\ServiceServices\ServiceServiceInterface;
use \App\Services\ServiceServices\ServiceService;
use \App\Repositories\ServiceRepositories\ServiceRepository;
use \App\Repositories\ServiceRepositories\ServiceRepositoryInterface;
use Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // BINDING REPOSITORIES PLACEHOLDER
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(VersionRepositoryInterface::class, VersionRepository::class);
        $this->app->bind(SliderRepositoryInterface::class, SliderRepository::class);
        $this->app->bind(PreferenceRepositoryInterface::class, PreferenceRepository::class);
        $this->app->bind(UnitRepositoryInterface::class, UnitRepository::class);
        $this->app->bind(OrderLineRepositoryInterface::class, OrderLineRepository::class);
        $this->app->bind(OrderHeaderRepositoryInterface::class, OrderHeaderRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);

        // BINDING SERVICES PLACEHOLDER
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(VersionServiceInterface::class, VersionService::class);
        $this->app->bind(SliderServiceInterface::class, SliderService::class);
        $this->app->bind(PreferenceServiceInterface::class, PreferenceService::class);
        $this->app->bind(UnitServiceInterface::class, UnitService::class);
        $this->app->bind(OrderLineServiceInterface::class, OrderLineService::class);
        $this->app->bind(OrderHeaderServiceInterface::class, OrderHeaderService::class);
        $this->app->bind(ArticleServiceInterface::class, ArticleService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(ServiceServiceInterface::class, ServiceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('sms', function () {
            return Http::baseUrl(env('GAP_API_BASE_URL'))->withQueryParameters([
                'username' => env('GAP_USERNAME'),
                'password' => env('GAP_PASSWORD'),
                'coding' => 2,
                'charset' => 'utf-8',
                'from' => 'landry',
            ]);
        });
    }
}
