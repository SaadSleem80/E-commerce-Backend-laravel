<?php

namespace App\Providers;

use App\Http\Repositories\Color\Interface\ColorRepositoryInterface;
use App\Http\Repositories\Color\Eloquent\ColorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ColorRepositoryInterface::class, ColorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
