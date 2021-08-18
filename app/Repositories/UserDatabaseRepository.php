<?php

namespace App\Repositories;

use App\Domain\Interfaces\Users\IUserEntity;
use App\Domain\Interfaces\Users\IUserRepository;
use App\Models\PasswordValueObject;
use App\Models\User;

class UserDatabaseRepository implements IUserRepository
{
    public function exists(IUserEntity $user): bool
    {
        return User::where([
            'name' => $user->getName(),
            'email' => (string) $user->getEmail(),
        ])->exists();
    }

    public function create(IUserEntity $user, PasswordValueObject $password): IUserEntity
    {
        return User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $password,
        ]);
    }
}
