<?php

namespace App\Domain\UseCases\Items\GetItems;

use App\Domain\Entities\RequestModel;

class GetItemsRequestModel extends RequestModel
{
    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->attributes['keywords'] ?? null;
    }
}
