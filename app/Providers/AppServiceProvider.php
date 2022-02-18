<?php

namespace App\Providers;

use App\Http\Controllers\PostController;
use App\Repository\ServiceInterface;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->when(PostController::class)
            ->needs(ServiceInterface::class)
            ->give(PostService::class);
    }
}
