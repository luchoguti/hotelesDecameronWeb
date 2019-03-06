<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAcomodacion extends Model
{
    public $table = "tipo_acomodacion";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tipo_acom','descripcion_tipo_acom'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
