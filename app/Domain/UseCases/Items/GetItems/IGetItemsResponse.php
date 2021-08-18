<?php

namespace App\Domain\UseCases\Items\GetItems;

use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\Items\IItem;
use Illuminate\Support\Collection;

interface IGetItemsResponse
{
    public function itemsCollection(Collection $items): IJsonResponse;

    public function badRequest(string $message): IJsonResponse;
}
