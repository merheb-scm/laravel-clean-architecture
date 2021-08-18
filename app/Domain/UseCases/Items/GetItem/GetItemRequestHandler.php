<?php

namespace App\Domain\UseCases\Items\GetItem;

use App\Domain\Entities\RequestModel;
use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\IRequestHandler;
use App\Domain\Interfaces\Items\IItemRepository;

class GetItemRequestHandler implements IRequestHandler
{
    public function __construct(
        private IGetItemResponse $output,
        private IItemRepository   $repository,
    ) {
    }

    /**
     * @param GetItemRequestModel|RequestModel $requestModel
     *
     * @return IJsonResponse
     */
    public function handle(GetItemRequestModel|RequestModel $requestModel): IJsonResponse
    {
        if (!is_a($requestModel, GetItemRequestModel::class)) {
            return $this->output->badRequest('Incorrect Input Type');
        }

        $item = $this->repository->find($requestModel->getId());
        if (!$item) {
            return $this->output->itemNotFound("Item {$requestModel->getId()} is not found");
        }

        return $this->output->itemResourceResponse($item);
    }
}
