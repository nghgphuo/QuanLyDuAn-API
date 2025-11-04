<?php

namespace App\Providers;


use App\Repositories\Task\ITaskRepository;
use App\Repositories\Task\TaskRepository;
use App\Services\Task\ITaskService;
use App\Services\Task\TaskService;
use App\Services\User\IUserService;
use App\Services\user\UserService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(ITaskService::class, TaskService::class);
    
    
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
