<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model
{
    public $table = "tipo_habitacion";
    protected $primaryKey = 'id_tipo_hab';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tipo_hab','descripcion_tipo_hab'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
