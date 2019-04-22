<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        	'nombre' => 'Region de Tarapaca',
        	'numero' => '1',
        ]);

        DB::table('regiones')->insert([
        	'nombre' => 'Region de Antofagasta',
        	'numero' => '2',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Atacama',
        	'numero' => '3',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Coquimbo',
        	'numero' => '4',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Valparaiso',
        	'numero' => '5',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region del Libertador General Bernardo O´Higgin',
        	'numero' => '6',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region del Maule',
        	'numero' => '7',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Concepcion',
        	'numero' => '8',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region del Araucania',
        	'numero' => '9',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region los Lagos',
        	'numero' => '10',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Aysen del General Carlos Ibañes del Campo',
        	'numero' => '11',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Magallanes y de la Antartica Chilena',
        	'numero' => '12',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region Metropolitana',
        	'numero' => '13',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de los Rios',
        	'numero' => '14',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Arica y Parinacota',
        	'numero' => '15',
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region del Nuble',
        	'numero' => '16',
        ]);


    }
}
