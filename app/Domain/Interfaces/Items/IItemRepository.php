<?php

namespace App\Domain\Interfaces\Items;

use Illuminate\Support\Collection;

interface IItemRepository
{
    public function exists(IItem $itemEntity): bool;

    public function create(IItem $itemEntity): IItem;

    public function find(int $id): ?IItem;

    public function findByKeywords(?string $keywords): Collection;

    public function update(IItem $itemEntity): IItem;

    public function delete(int $id): void;
}
