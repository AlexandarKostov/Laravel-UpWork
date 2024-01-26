<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image' => $this->image,
            'name' => strtoupper($this->name),
            'surname' => strtoupper($this->surname),
            'email' => $this->email,
            'short_bio' => $this->short_bio,
            'skill' => $this->skill,
            'academy' => $this->academy,
        ];
    }
}
