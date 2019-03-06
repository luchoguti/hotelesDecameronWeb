<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HabitAcomdResources extends JsonResource
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
            'id_tipo_hab_acomd'=>$this->id_tipo_hab_acomd,
            'id_tipo_hab'=>$this->id_tipo_hab,
            'acomodacion'=>TipoAcomodacionResources::collection($this->whenLoaded('ForenkAcomdacion')),
            'habitacion'=> TipoHabitacionResources::collection($this->whenLoaded('ForenkHabit'))
        ];
    }
}
