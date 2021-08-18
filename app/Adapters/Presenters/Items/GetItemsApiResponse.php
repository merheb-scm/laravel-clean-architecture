<?php

namespace App\Adapters\Presenters\Items;

use App\Adapters\ViewModels\ApiResponseModel;
use App\Domain\Interfaces\IJsonResponse;
use App\Domain\UseCases\Items\GetItems\IGetItemsResponse;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;

class GetItemsApiResponse implements IGetItemsResponse
{
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

    /**
     * @param Collection<Item> $items
     *
     * @return IJsonResponse
     */
    public function itemsCollection(Collection $items): IJsonResponse
    {
        return new ApiResponseModel(response()->json(ItemResource::collection($items)));
    }
}
