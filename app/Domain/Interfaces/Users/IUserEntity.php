<?php

namespace App\Domain\Interfaces\Users;

use App\Models\EmailValueObject;
use App\Models\HashedPasswordValueObject;
use App\Models\PasswordValueObject;

interface IUserEntity
{
    public function getName(): string;

    public function setName(string $name): void;

    public function getEmail(): EmailValueObject;

    public function setEmail(EmailValueObject $email): void;

    public function getPassword(): HashedPasswordValueObject;

    public function setPassword(PasswordValueObject $password): void;
}
