<?php

namespace App\Adapters\Presenters\Items;

use App\Adapters\ViewModels\ApiResponseModel;
use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\Items\IItem;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Exceptions\HttpResponseException;

Abstract class ItemApiResponse
{
    /**
     * @param IItem $item
     *
     * @return IJsonResponse
     */
    public function itemResourceResponse(IItem $item): IJsonResponse
    {
        return new ApiResponseModel(response()->json(new ItemResource(Item::fromEntity($item))));
    }

    /**
     * @param string $message
     *
     * @return IJsonResponse
     */
    public function itemNotFound(string $message): IJsonResponse
    {
        throw new HttpResponseException(
            response()->json(['errors' => [$message]])
        );
    }

    /**
     * @param string $message
     *
     * @return IJsonResponse
     */
    public function badRequest(string $message): IJsonResponse
    {
        throw new HttpResponseException(
            response()->json(['errors' => [$message]])
        );
    }
}
