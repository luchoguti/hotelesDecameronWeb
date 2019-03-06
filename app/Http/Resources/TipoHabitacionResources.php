<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoHabitacionResources extends JsonResource
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
            'id_tipo_hab'=>$this->id_tipo_hab,
            'descripcion_tipo_hab'=>$this->descripcion_tipo_hab
        ];
    }
}
