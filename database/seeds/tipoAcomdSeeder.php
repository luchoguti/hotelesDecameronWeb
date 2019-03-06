<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipoAcomdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_acomodacion')->insert([
            'descripcion_tipo_acom' => 'Sencilla'
        ]);
        DB::table('tipo_acomodacion')->insert([
            'descripcion_tipo_acom' => 'Doble'
        ]);
        DB::table('tipo_acomodacion')->insert([
            'descripcion_tipo_acom' => 'Triple'
        ]);
        DB::table('tipo_acomodacion')->insert([
            'descripcion_tipo_acom' => 'Cuádruple'
        ]);
    }
}
