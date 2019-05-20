<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RegionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        DB::table('regiones')->insert([
        	'nombre' => 'Araucania',
        	'numero' => '9',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Los Lagos',
        	'numero' => '10',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Aysen del General Carlos Ibañes del Campo',
        	'numero' => '11',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);          
        DB::table('regiones')->insert([
        	'nombre' => 'Los Rios',
        	'numero' => '14',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);       


    }
}
