<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelHabit extends Model
{
    public $table = "hoteles_habit";
    protected $primaryKey = 'id_hoteles_habit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_hoteles_habit','numero_hoteles_habit','id_tipo_hab_acomd','id_hotel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
