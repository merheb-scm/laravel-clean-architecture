<?php

namespace App\Adapters\Presenters\Items;

use App\Adapters\ViewModels\ApiResponseModel;
use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\Items\IItem;
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
     * @param Collection<IItem> $items
     *
     * @return IJsonResponse
     */
    public function itemsCollection(Collection $items): IJsonResponse
    {
        $itemsResource = $items->map(function (IItem $item){
            return new ItemResource(Item::fromEntity($item));
        });

        return new ApiResponseModel(response()->json($itemsResource));
    }
}
