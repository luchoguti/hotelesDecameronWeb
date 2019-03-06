<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoAcomodacionResources extends JsonResource
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
            'id_tipo_acom'=>$this->id_tipo_acom,
            'descripcion_tipo_acom'=>$this->descripcion_tipo_acom,
        ];
    }
}
