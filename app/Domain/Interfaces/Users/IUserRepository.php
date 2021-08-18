<?php

namespace App\Domain\Interfaces\Users;

use App\Models\PasswordValueObject;

interface IUserRepository
{
    public function exists(IUserEntity $user): bool;

    public function create(IUserEntity $user, PasswordValueObject $password): IUserEntity;
}
