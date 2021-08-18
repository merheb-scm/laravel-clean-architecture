<?php

namespace App\Http\Controllers;

use App\Adapters\ViewModels\ApiResponseModel;
use App\Domain\UseCases\Items\CreateItem\CreateItemRequestHandler;
use App\Domain\UseCases\Items\CreateItem\CreateItemRequestModel;
use App\Domain\UseCases\Items\GetItem\GetItemRequestHandler;
use App\Domain\UseCases\Items\GetItem\GetItemRequestModel;
use App\Domain\UseCases\Items\GetItems\GetItemsRequestHandler;
use App\Domain\UseCases\Items\GetItems\GetItemsRequestModel;
use App\Domain\UseCases\Items\UpdateItem\UpdateItemRequestHandler;
use App\Domain\UseCases\Items\UpdateItem\UpdateItemRequestModel;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    public function __construct(
        protected GetItemRequestHandler    $getItemRequestHandler,
        protected GetItemsRequestHandler   $getItemsRequestHandler,
        protected CreateItemRequestHandler $createItemRequestHandler,
        protected UpdateItemRequestHandler $updateItemIRequestHandler
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse|null
     */
    public function index(Request $request): ?JsonResponse
    {
        // Simple method via Laravel
        // return response()->json(ItemResource::collection(Item::all()));

        $requestModel  = new GetItemsRequestModel($request->all());
        $responseModel = $this->getItemsRequestHandler->handle($requestModel);

        if ($responseModel instanceof ApiResponseModel) {
            return $responseModel->getResponse();
        }

        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateItemRequest $request
     *
     * @return JsonResponse|null
     */
    public function store(CreateItemRequest $request)
    {
        $requestModel  = new CreateItemRequestModel($request->validated());
        $responseModel = $this->createItemRequestHandler->handle($requestModel);

        if ($responseModel instanceof ApiResponseModel) {
            return $responseModel->getResponse();
        }

        return null;
    }

    /**
     * Display the specified resource directly without passing through the domain
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $item = Item::find($id);
        if (!$item) {
            throw new HttpResponseException(
                response()->json(['errors' => ['Item Not Found']], 404)
            );
        }

        return response()->json(new ItemResource($item));
    }

    /**
     * Display the specified resource using the ResponseModel passing through the domain
     *
     * @param int $id
     *
     * @return JsonResponse|null
     */
    public function edit($id): ?JsonResponse
    {
        $requestModel  = new GetItemRequestModel(['id' => $id]);
        $responseModel = $this->getItemRequestHandler->handle($requestModel);
        if ($responseModel instanceof ApiResponseModel) {
            return $responseModel->getResponse();
        }

        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItemRequest $request
     * @param int               $id
     *
     * @return JsonResponse|null
     */
    public function update(UpdateItemRequest $request, int $id): ?JsonResponse
    {
        $requestModel = new UpdateItemRequestModel($request->validated());
        if ($requestModel->getId() != $id) {
            throw new HttpResponseException(
                response()->json(['errors' => ['id' => ['Bad Request']]], 400)
            );
        }
        $responseModel = $this->updateItemIRequestHandler->handle($requestModel);

        if ($responseModel instanceof ApiResponseModel) {
            return $responseModel->getResponse();
        }

        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
