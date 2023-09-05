<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartProductResource extends JsonResource
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
            'name' => $this->specifications['name'],
            'price_per_unit' => $this->specifications['price'],
            'preview_image' => $this->images->first() == null ? '' : Storage::url($this->images->first()->url),
            'price_for_count' => $this->price_for_count,
            'items_count' => $this->items_count,
        ];
    }
}
