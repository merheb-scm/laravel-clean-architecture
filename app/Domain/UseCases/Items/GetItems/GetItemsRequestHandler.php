<?php

namespace App\Domain\UseCases\Items\GetItems;

use App\Domain\Entities\RequestModel;
use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\IRequestHandler;
use App\Domain\Interfaces\Items\IItemRepository;

class GetItemsRequestHandler implements IRequestHandler
{
    public function __construct(
        private IGetItemsResponse $output,
        private IItemRepository   $repository,
    ) {
    }

    /**
     * @param GetItemsRequestModel|RequestModel $requestModel
     *
     * @return IJsonResponse
     */
    public function handle(GetItemsRequestModel|RequestModel $requestModel): IJsonResponse
    {
        if (!($requestModel instanceof GetItemsRequestModel)) {
            return $this->output->badRequest('Incorrect Input Type');
        }

        // NB. items is a collection of Laravel Model <Item> -> this a problem, we solve it without doing double conversion
        $items = $this->repository->findByKeywords($requestModel->getKeywords());

        return $this->output->itemsCollection($items);
    }
}
