<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CiudadesResources as CiudadesResources;
use App\Ciudad;

class CiudadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CiudadesResources::collection(Ciudad::all());  
    }
}
