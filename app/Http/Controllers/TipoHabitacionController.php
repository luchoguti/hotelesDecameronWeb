<?php

namespace App\Http\Controllers;
use App\Http\Resources\TipoHabitacionResources as TipoHabitacionResources;
use App\TipoHabitacion;
use Illuminate\Http\Request;

class TipoHabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoHabitacionResources::collection(TipoHabitacion::all());  
    }
}
