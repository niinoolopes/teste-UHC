<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"          => $this->id,
            "description" => $this->description,
            "enable"      => $this->enable,
            "created_at"  => date('d/m/Y h:s:i', strtotime($this->created_at)),
        ];
    }
}
