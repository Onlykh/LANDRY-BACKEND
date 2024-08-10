<?php

namespace App\Http\Resources\SliderResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'entitled' => $this->entitled,
            'description' => $this->description,
            'image' => $this->image,
            'link' => $this->link,
            'is_active' => $this->is_active,
            'position' => $this->position,
        ];
    }
}
