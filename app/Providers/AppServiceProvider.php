<?php

namespace App\Providers;

use App\Interfaces\OptionRepositoryInterface;
use App\Interfaces\QuestionRepositoryInterface;
use App\Interfaces\VoteRepositoryInterface;
use App\Repositories\OptionRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\VoteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(VoteRepositoryInterface::class, VoteRepository::class);
        $this->app->bind(OptionRepositoryInterface::class, OptionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
