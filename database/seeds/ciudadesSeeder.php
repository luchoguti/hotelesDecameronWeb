<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ciudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ciudades')->insert([
            'nom_ciudad' => 'Bogota'
        ]);
        DB::table('ciudades')->insert([
            'nom_ciudad' => 'Barranquilla'
        ]);
        DB::table('ciudades')->insert([
            'nom_ciudad' => 'Bucaramanga'
        ]);
        DB::table('ciudades')->insert([
            'nom_ciudad' => 'Medellin'
        ]);
    }
}
