<?php

namespace App\Http\Resources;
use App\HabitAcomd;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class HotelHabitResources extends JsonResource
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
            'id_hoteles_habit'=>$this->id_hoteles_habit,
            'numero_hoteles_habit'=>$this->numero_hoteles_habit,
            'hab_acomd'=> HabitAcomdResources::collection(HabitAcomd::where('id_tipo_hab_acomd','=',$this->id_tipo_hab_acomd)->with(['ForenkAcomdacion','ForenkHabit'])->get()),
            'id_hotel'=>$this->id_hotel
        ];
    }
}
