<?php

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\CliIViewModel;
use App\Domain\Interfaces\IViewModel;
use App\Domain\UseCases\CreateUser\CreateUserOutputPort;
use App\Domain\UseCases\CreateUser\CreateUserResponseModel;
use Illuminate\Console\Command;

class CreateUserCliPresenter implements CreateUserOutputPort
{
    public function userCreated(CreateUserResponseModel $model): IViewModel
    {
        return new CliIViewModel(function (Command $command) use ($model): int {
            $command->info("User {$model->getUser()->getName()} successfully created.");
            return Command::SUCCESS;
        });
    }

    public function userAlreadyExists(CreateUserResponseModel $model): IViewModel
    {
        return new CliIViewModel(function (Command $command) use ($model): int {
            $command->error("User {$model->getUser()->getEmail()} already exists!");
            return Command::FAILURE;
        });
    }

    public function unableToCreateUser(CreateUserResponseModel $model, \Throwable $e): IViewModel
    {
        return new CliIViewModel(function (Command $command) use ($e): int {
            $command->error("Error occured while creating user: {$e->getMessage()}");
            return Command::FAILURE;
        });
    }
}
