<?php

namespace App\Adapters\Presenters\Items;

use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\Items\IItem;
use App\Domain\UseCases\Items\CreateItem\ICreateItemResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateItemApiResponse extends ItemApiResponse implements ICreateItemResponse
{
    /**
     * @param string $message
     *
     * @return IJsonResponse
     */
    public function itemAlreadyExists(string $message): IJsonResponse
    {
        throw new HttpResponseException(
            response()->json(['errors' => [$message]])
        );
    }

    public function unableToCreateItem(IItem $item, \Exception $exception): IJsonResponse
    {
        $message = "Unable to create item : {$item->getTitle()} ";
        throw new HttpResponseException(
            response()->json(['errors' => [$message]])
        );
    }
}
