<?php

namespace App\Domain\UseCases\CreateUser;

use App\Domain\Interfaces\Users\IUserEntity;

class CreateUserResponseModel
{
    public function __construct(
        private IUserEntity $user
    ) {
    }

    public function getUser(): IUserEntity
    {
        return $this->user;
    }
}
