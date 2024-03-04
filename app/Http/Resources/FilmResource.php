<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'release_year' => $this->release_year,
            'language_id' => $this->language_id,
            'rental_rate' => $this->rental_rate,
            'length' => $this->length
        ];
    }
}
