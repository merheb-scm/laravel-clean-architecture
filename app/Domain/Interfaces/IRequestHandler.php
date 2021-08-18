<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\RequestModel;

interface IRequestHandler
{
    public function handle(RequestModel $requestModel): IJsonResponse;
}
