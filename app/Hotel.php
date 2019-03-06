<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public $table = "hoteles";
    protected $primaryKey = 'id_hotel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_hotel','nombre_ho','direccion_ho','nit','numero_habit','id_ciudad'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    public function ForenkCuidad(){
        return $this->hasMany('App\Ciudad','id_ciudad','id_ciudad');
    }
    public function HotelDescripDetall(){
        return $this->hasMany('App\HotelHabit','id_hotel','id_hotel');
        //return $this->belongsTo('App\HotelHabit','id_hotel');
    }
}
