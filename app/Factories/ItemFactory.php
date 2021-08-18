<?php

namespace App\Factories;

use App\Domain\Entities\Item;
use App\Domain\Interfaces\Items\IItem;
use App\Domain\Interfaces\Items\IItemFactory;


class ItemFactory implements IItemFactory
{
    public function make(array $attributes = []): IItem
    {
        $item = new Item();
        $item->setTitle($attributes['title'] ?? null);
        $item->setDescription($attributes['description'] ?? null);

        return $item;
    }
}
