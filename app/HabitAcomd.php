<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HabitAcomd extends Model
{
    public $table = "tipo_hab_acomd";
    protected $primaryKey = 'id_tipo_hab_acomd';

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tipo_hab_acomd','id_tipo_acom','id_tipo_hab'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    public function ForenkAcomdacion(){
        return $this->hasMany('App\TipoAcomodacion','id_tipo_acom','id_tipo_acom');
    }
    public function ForenkHabit(){
        return $this->hasMany('App\TipoHabitacion','id_tipo_hab','id_tipo_hab');
    }
}
