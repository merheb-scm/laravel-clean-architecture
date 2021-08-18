<?php

namespace App\Domain\Interfaces\Users;

interface IUserFactory
{
    /**
     * @param array<mixed> $attributes
     */
    public function make(array $attributes = []): IUserEntity;
}
