<?php

namespace App\Domain\UseCases\Items\CreateItem;

use App\Domain\Entities\RequestModel;
use App\Domain\Interfaces\IJsonResponse;
use App\Domain\Interfaces\IRequestHandler;
use App\Domain\Interfaces\Items\IItemFactory;
use App\Domain\Interfaces\Items\IItemRepository;

class CreateItemRequestHandler implements IRequestHandler
{
    public function __construct(
        private ICreateItemResponse $output,
        private IItemRepository $repository,
        private IItemFactory $factory
    ) {
    }

    public function handle(CreateItemRequestModel|RequestModel $requestModel): IJsonResponse
    {
        if (!($requestModel instanceof CreateItemRequestModel))
        {
           return $this->output->badRequest('Incorrect Input Type');
        }

        $itemEntity = $this->factory->make([
                                         'title'  => $requestModel->getTitle(),
                                         'description' => $requestModel->getDescription(),
                                     ]);

        // this condition is not needed here because we already check it in the Request Validator in Laravel
        if ($this->repository->exists($itemEntity)) {
            return $this->output->itemAlreadyExists('Item title already exists');
        }

        try {
            $item = $this->repository->create($itemEntity);
        } catch (\Exception $e) {
            return $this->output->unableToCreateItem($itemEntity, $e);
        }

        return $this->output->itemResourceResponse($item);
    }
}
