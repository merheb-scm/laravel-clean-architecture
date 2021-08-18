<?php

namespace App\Domain\UseCases\Items\UpdateItem;

use App\Domain\Entities\RequestModel;
use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\IRequestHandler;
use App\Domain\Interfaces\Items\IItemRepository;

class UpdateItemRequestHandler implements IRequestHandler
{
    public function __construct(
        private IUpdateItemResponse $output,
        private IItemRepository     $repository,
    ) {
    }

    public function handle(UpdateItemRequestModel|RequestModel $requestModel): IJsonResponse
    {
        if (!is_a($requestModel, UpdateItemRequestModel::class)) {
            return $this->output->badRequest('Incorrect Input Type');
        }

        $item = $this->repository->find($requestModel->getId());
        if (!$item) {
            return $this->output->itemNotFound("Item {$requestModel->getId()} is not found");
        }
        $item->setTitle($requestModel->getTitle());
        $item->setDescription($requestModel->getDescription());
        $this->repository->update($item);

        return $this->output->itemResourceResponse($item);
    }
}
