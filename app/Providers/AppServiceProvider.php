<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Contact\ContactRepositoryImplement;
use App\Services\Contact\ContactService;
use App\Services\Contact\ContactServiceImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ContactRepository::class, ContactRepositoryImplement::class);
        $this->app->bind(ContactService::class, ContactServiceImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
