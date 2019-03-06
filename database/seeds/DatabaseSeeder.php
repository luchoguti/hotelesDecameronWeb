<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'ciudades',
            'tipo_acomodacion',
            'tipo_habitacion',
            'tipo_hab_acomd'
        ]);
        // $this->call(UsersTableSeeder::class);
        $this->call(ciudadesSeeder::class);
        $this->call(tipoAcomdSeeder::class);
        $this->call(tipoHabitSeeder::class);
        $this->call(habitAcomdSeeder::class);

    }
    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
 
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
 
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
