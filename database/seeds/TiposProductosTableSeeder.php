<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TiposProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_productos')->insert([
        	'nombre' => 'Carozzi',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('tipos_productos')->insert([
        	'nombre' => 'Competencia',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
    }
}
