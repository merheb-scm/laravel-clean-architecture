<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\IViewModel;

interface CreateUserInputPort
{
    public function createUser(CreateUserRequestModel $model): IViewModel;
}
