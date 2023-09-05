<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'specifications' => $this->specifications,
            'images' => ImageResource::collection($this->images),
            'reviews' => ReviewResource::collection($this->reviews->where('published', true)->get())
        ];
    }
}
