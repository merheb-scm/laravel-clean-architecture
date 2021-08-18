<?php

namespace App\Domain\Interfaces\Items;

interface IItemFactory
{
    /**
     * @param array $attributes
     */
    public function make(array $attributes = []): IItem;
}
