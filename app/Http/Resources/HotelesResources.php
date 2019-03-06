<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelesResources extends JsonResource
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
            'id_hotel'=>$this->id_hotel,
            'nombre_ho'=>$this->nombre_ho,
            'direccion_ho'=>$this->direccion_ho,
            'nit'=>$this->nit,
            'numero_habit'=>$this->numero_habit,
            'ciudad'=> CiudadesResources::collection($this->whenLoaded('ForenkCuidad')),
            'hotel_descrip_detalle'=> HotelHabitResources::collection($this->whenLoaded('HotelDescripDetall'))
            
        ];
        //new HotelHabitResources($this->HotelDescripDetall) HotelDescripDetall
    }
}
