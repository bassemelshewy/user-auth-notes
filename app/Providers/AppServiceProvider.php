<?php

namespace App\Providers;

use App\Repositories\Note\NoteEloquent;
use App\Repositories\Note\NoteInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NoteInterface::class, NoteEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
