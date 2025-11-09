<?php

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'path' => $this->path,
            'alt_text' => $this->alt_text,
            'is_show' => $this->is_show,
        ];
    }
}
