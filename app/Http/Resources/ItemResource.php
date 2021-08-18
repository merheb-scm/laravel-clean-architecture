<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property string title
 * @property string description
 *
 */
class ItemResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['title' => "string", 'description' => "string"])]
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}
