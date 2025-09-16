<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Eloquent\StudentRepository;
use App\Repositories\Contracts\DocumentRequestRepositoryInterface;
use App\Repositories\Eloquent\DocumentRequestRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(DocumentRequestRepositoryInterface::class, DocumentRequestRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
