<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'comment' => $this->comment,
            'advantages' => $this->advantages,
            'disadvantages' => $this->disadvantages,
            'rating' => $this->rating,
            'created_at' => $this->created_at->format('d.m.Y h:i'),
            'customer' => new CustomerResource($this->customer)
        ];
    }
}
