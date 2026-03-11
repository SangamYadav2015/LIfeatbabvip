<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Repositories\JobApplicationRepositoryInterface;
use App\Repositories\JobApplicationRepository;
use App\Repositories\ApplicantRepository;
use App\Repositories\ApplicantRepositoryInterface;
use App\Services\ApplicantService;
use App\Services\ApplicantServiceInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(JobApplicationRepositoryInterface::class, JobApplicationRepository::class);
        $this->app->bind(ApplicantRepositoryInterface::class, ApplicantRepository::class);
        $this->app->bind(ApplicantServiceInterface::class, ApplicantService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Schema::defaultStringLength(191);
        

    }
}
