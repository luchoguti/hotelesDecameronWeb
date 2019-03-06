<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public $table = "ciudades";
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_ciudad','nom_ciudad'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
