<?php

namespace App\Domain\Interfaces\Items;

use App\Domain\Interfaces\IAuditableEntity;

interface IItem extends IAuditableEntity
{
    public function getTitle(): ?string;
    public function setTitle(?string $title): void;

    public function getDescription(): ?string;
    public function setDescription(?string $description): void;
}
