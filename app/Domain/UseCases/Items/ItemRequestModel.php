<?php

namespace App\Domain\UseCases\Items;

use App\Domain\Entities\RequestModel;

class ItemRequestModel extends RequestModel
{
    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->attributes['title'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->attributes['description'] ?? null;
    }
}
