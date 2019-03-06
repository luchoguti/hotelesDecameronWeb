<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CiudadesResources extends JsonResource
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
            'id_ciudad'=>$this->id_ciudad,
            'nom_ciudad'=>$this->nom_ciudad
        ];
    }
}
