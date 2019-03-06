<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoHabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_habitacion')->insert([
            'descripcion_tipo_hab' => 'Estándar'
        ]);
        DB::table('tipo_habitacion')->insert([
            'descripcion_tipo_hab' => 'Junior'
        ]);
        DB::table('tipo_habitacion')->insert([
            'descripcion_tipo_hab' => 'Suite'
        ]);
    }
}
