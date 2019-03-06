<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\HotelesResources as HotelesResources;
use App\Hotel;
use App\HotelHabit;

class HotelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HotelesResources::collection(Hotel::with(['ForenkCuidad','HotelDescripDetall'])->get()); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sql_nom_hotel=Hotel::where('nombre_ho','=',$request->hotel_info_basica['nombre'])->get();
        $sql_nit_hotel=Hotel::where('nit','=',$request->hotel_info_basica['nit'])->get();
        $cant_nit_hotel=$sql_nit_hotel->count();        
        $cant_nom_hotel=$sql_nom_hotel->count();
        if($cant_nom_hotel == 0 && $cant_nit_hotel == 0){
            $insertHoteles=Hotel::create([
                "nombre_ho"=>$request->hotel_info_basica['nombre'],
                "direccion_ho"=>$request->hotel_info_basica['direccion'],
                "nit"=>$request->hotel_info_basica['nit'],
                "numero_habit"=>$request->hotel_info_basica['num_hab'],
                "id_ciudad"=>$request->hotel_info_basica['ciudad']
            ]);
            foreach ($request->hotel_info_detall as $hotel_info_detall) {
                HotelHabit::create([
                    "numero_hoteles_habit"=>$hotel_info_detall['cantidad'],
                    "id_tipo_hab_acomd"=>$hotel_info_detall['hab_acomd'],
                    "id_hotel"=>$insertHoteles->id_hotel
                ]);
            }
            $dataRespose['status'] = 201;
            $dataRespose['message'] = "Hotel Creado exitosamente.";
            return response()->json($dataRespose, 201);
        }else{
            $dataRespose['status'] = 404;
            if($cant_nom_hotel > 0){
                $dataResposeMsg[0] = "El Hotel ".$request->hotel_info_basica['nombre']." ya se encuentra registrado!";
            }
            if($cant_nit_hotel > 0){
                $dataResposeMsg[1] = "El Nit ".$request->hotel_info_basica['nit']." ya se encuentra registrado!";
            }
            $dataRespose['message'] = json_encode($dataResposeMsg);
            return response()->json($dataRespose, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel=Hotel::where('id_hotel','=',$id)->get();
        $cant_hotel=$hotel->count();        
        if($cant_hotel !=0){
            return HotelesResources::collection(Hotel::where('id_hotel','=',$id)->with(['ForenkCuidad','HotelDescripDetall'])->get());
        }else{
            $dataRespose['status'] = 404;
            $dataRespose['message'] = "El Hotel solicitado no existe.";
            return response()->json($dataRespose, 404);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $insertHoteles=Hotel::where('id_hotel','=',$id)->update([
            "nombre_ho"=>$request->hotel_info_basica['nombre'],
            "direccion_ho"=>$request->hotel_info_basica['direccion'],
            "nit"=>$request->hotel_info_basica['nit'],
            "numero_habit"=>$request->hotel_info_basica['num_hab'],
            "id_ciudad"=>$request->hotel_info_basica['ciudad']
        ]);
        $hotelHabit = HotelHabit::where('id_hotel','=',$id);
        $hotelHabit->delete();
        foreach ($request->hotel_info_detall as $hotel_info_detall) {
            HotelHabit::create([
                "numero_hoteles_habit"=>$hotel_info_detall['cantidad'],
                "id_tipo_hab_acomd"=>$hotel_info_detall['hab_acomd'],
                "id_hotel"=>$id
            ]);
        }
        $dataRespose['status'] = 201;
        $dataRespose['message'] = "Hotel actualizado exitosamente.";
        return response()->json($dataRespose, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotelHabit = HotelHabit::where('id_hotel','=',$id);
        $hotelHabit->delete();
        $hotel = Hotel::find($id);
        $hotel->delete();
        return response()->json('successfully deleted');
    }
}
