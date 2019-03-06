<?php

use Illuminate\Database\Seeder;

class habitAcomdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_hab_acomd')->insert([
            'id_tipo_hab' => 1,
            'id_tipo_acom' => 1
        ]);
        DB::table('tipo_hab_acomd')->insert([
            'id_tipo_hab' => 1,
            'id_tipo_acom' => 2
        ]);
        DB::table('tipo_hab_acomd')->insert([
            'id_tipo_hab' => 2,
            'id_tipo_acom' => 3
        ]);
        DB::table('tipo_hab_acomd')->insert([
            'id_tipo_hab' => 2,
            'id_tipo_acom' => 4
        ]);
        DB::table('tipo_hab_acomd')->insert([
            'id_tipo_hab' => 3,
            'id_tipo_acom' => 1
        ]);
        DB::table('tipo_hab_acomd')->insert([
            'id_tipo_hab' => 3,
            'id_tipo_acom' => 2
        ]);
        DB::table('tipo_hab_acomd')->insert([
            'id_tipo_hab' => 3,
            'id_tipo_acom' => 3
        ]);
    }
}
