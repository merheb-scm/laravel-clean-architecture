<?php

namespace App\Providers;

use App\Adapters\Presenters;
use App\Console\Commands;
use App\Domain;
use App\Factories;
use App\Http\Controllers as HttpControllers;
use App\Repositories;
use App\Domain\UseCases;
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
        $this->app->bind(
            Domain\Interfaces\Users\IUserFactory::class,
            Factories\UserModelFactory::class,
        );

        $this->app->bind(
            Domain\Interfaces\Users\IUserRepository::class,
            Repositories\UserDatabaseRepository::class,
        );

        $this->app
            ->when(HttpControllers\CreateUserController::class)
            ->needs(UseCases\CreateUser\CreateUserInputPort::class)
            ->give(function ($app) {
                return $app->make(UseCases\CreateUser\CreateUserInteractor::class, [
                    'output' => $app->make(Presenters\CreateUserHttpPresenter::class),
                ]);
            });

        $this->app
            ->when(Commands\CreateUserCommand::class)
            ->needs(UseCases\CreateUser\CreateUserInputPort::class)
            ->give(function ($app) {
                return $app->make(UseCases\CreateUser\CreateUserInteractor::class, [
                    'output' => $app->make(Presenters\CreateUserCliPresenter::class),
                ]);
            });


        $this->app->bind(
            Domain\Interfaces\Items\IItemFactory::class,
            Factories\ItemFactory::class,
        );

        $this->app->bind(
            Domain\Interfaces\Items\IItemRepository::class,
            Repositories\ItemRepository::class,
        );

        $this->app->bind(
            Domain\UseCases\Items\GetItem\IGetItemResponse::class,
            Presenters\Items\GetItemApiResponse::class,
        );

        $this->app->bind(
            Domain\UseCases\Items\GetItems\IGetItemsResponse::class,
            Presenters\Items\GetItemsApiResponse::class,
        );

        $this->app->bind(
            Domain\UseCases\Items\CreateItem\ICreateItemResponse::class,
            Presenters\Items\CreateItemApiResponse::class,
        );
        $this->app->bind(
            Domain\UseCases\Items\UpdateItem\IUpdateItemResponse::class,
            Presenters\Items\UpdateItemApiResponse::class,
        );
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
