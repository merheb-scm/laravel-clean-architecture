<?php

namespace App\Domain\UseCases\Items\GetItem;

use App\Domain\Entities\RequestModel;

class GetItemRequestModel extends RequestModel
{
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }
}
