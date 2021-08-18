<?php

namespace App\Domain\UseCases\Items\UpdateItem;

use App\Domain\UseCases\Items\ItemRequestModel;

class UpdateItemRequestModel extends ItemRequestModel
{
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }
}
