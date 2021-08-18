<?php

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\IJsonResponse;
use Illuminate\Http\JsonResponse;

class ApiResponseModel implements IJsonResponse
{
    public function __construct(protected JsonResponse $response)
    {

    }

    public function getResponse(): JsonResponse
    {
        return $this->response;
    }
}
