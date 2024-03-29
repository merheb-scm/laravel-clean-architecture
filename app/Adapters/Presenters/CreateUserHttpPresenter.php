<?php

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\HttpResponseViewModel;
use App\Domain\Interfaces\IViewModel;
use App\Domain\UseCases\CreateUser\CreateUserOutputPort;
use App\Domain\UseCases\CreateUser\CreateUserResponseModel;

class CreateUserHttpPresenter implements CreateUserOutputPort
{
    public function userCreated(CreateUserResponseModel $model): IViewModel
    {
        return new HttpResponseViewModel(
            app('view')
                ->make('user.show')
                ->with(['user' => $model->getUser()])
        );
    }

    public function userAlreadyExists(CreateUserResponseModel $model): IViewModel
    {
        return new HttpResponseViewModel(
            app('redirect')
                ->route('user.create')
                ->withErrors(['create-user' => "User {$model->getUser()->getEmail()} alreay exists."])
        );
    }

    public function unableToCreateUser(CreateUserResponseModel $model, \Throwable $e): IViewModel
    {
        if (config('app.debug')) {
            // rethrow and let Laravel display the error
            throw $e;
        }

        return new HttpResponseViewModel(
            app('redirect')
                ->route('user.create')
                ->withErrors(['create-user' => "Error occured while creating user {$model->getUser()->getName()}"])
        );
    }
}
