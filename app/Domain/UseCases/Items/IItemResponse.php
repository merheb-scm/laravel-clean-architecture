<?php

namespace App\Domain\UseCases\Items;

use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\Items\IItem;

interface IItemResponse
{
    public function itemResourceResponse(IItem $item): IJsonResponse;

    public function itemNotFound(string $message): IJsonResponse;

    public function badRequest(string $message): IJsonResponse;
}
