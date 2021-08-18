<?php

namespace App\Domain\Entities;

abstract class RequestModel
{
    /**
     * @param array $attributes
     */
    public function __construct(
        protected array $attributes
    ) {
    }
}
