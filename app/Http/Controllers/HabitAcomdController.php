<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\HabitAcomdResources as HabitAcomdResources;
use App\HabitAcomd;

class HabitAcomdController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * example url:
     * 
     * 127.0.0.1:8000/api/orders/?fecha_init=2019-02-13&fecha_end=2019-02-13
     * 
     */
    public function index()
    {
        if(request()->filled('id_tipo_hab')){
            return HabitAcomdResources::collection(HabitAcomd::where('id_tipo_hab','=',request()->id_tipo_hab)->with(['ForenkAcomdacion','ForenkHabit'])->get());  
        }else{
            $dataRespose['status'] = 404;
            $dataRespose['message'] = "the parameters fecha_init and fecha_end must exist and can not be null, check please!";
            return response()->json($dataRespose, 404);
        }
    }

}
