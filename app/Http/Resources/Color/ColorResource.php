<?php

namespace App\Http\Resources\Color;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'        => $this->id,
            'name'      => $this->name,
            'hex_code'  => $this->hex_code,
        ];

        if(isset($request['dashboard'])){
            $data['name'] = [];

            $data['name']['en'] = $this->getTranslation('name', 'en');
            $data['name']['ar'] = $this->getTranslation('name', 'ar');

            $data['created_at'] = $this->created_at->toDateTimeString();
            $data['updated_at'] = $this->updated_at->toDateTimeString();
        }

        return $data;
    }
}
