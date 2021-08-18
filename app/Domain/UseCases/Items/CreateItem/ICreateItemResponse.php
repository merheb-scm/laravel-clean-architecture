<?php

namespace App\Domain\UseCases\Items\CreateItem;

use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\Items\IItem;
use App\Domain\UseCases\Items\IItemResponse;

interface ICreateItemResponse extends IItemResponse
{
    public function itemAlreadyExists(string $message): IJsonResponse;

    public function unableToCreateItem(IItem $item, \Exception $exception): IJsonResponse;
}
