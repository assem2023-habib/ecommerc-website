<?php

namespace App\Infrastructure\Providers;

use App\Domain\Repositories\{
    CategoryRepositoryInterface,
    ProductRepositoryInterface,
    UserRepositoryInterface,
    CountryRepositoryInterface,
    CityRepositoryInterface,
    AuthRepositoryInterface
};
use App\Infrastructure\Persistence\Eloquent\Repositories\{
    EloquentCategoryRepository,
    EloquentProductRepository,
    EloquentUserRepository,
    EloquentCountryRepository,
    EloquentCityRepository,
    AuthRepository
};
use App\Infrastructure\Services\FileStorageService;
use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // === Repository Bindings ===
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, EloquentCountryRepository::class);
        $this->app->bind(CityRepositoryInterface::class, EloquentCityRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);

        // === Service Bindings ===
        $this->app->bind(FileStorageService::class, function ($app) {
            return new FileStorageService();
        });
    }
}
