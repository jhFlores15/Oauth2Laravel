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
        	'nombre' => 'Region de Tarapaca',
        	'numero' => '1',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('regiones')->insert([
        	'nombre' => 'Region de Antofagasta',
        	'numero' => '2',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Atacama',
        	'numero' => '3',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Coquimbo',
        	'numero' => '4',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Valparaiso',
        	'numero' => '5',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region del Libertador General Bernardo O´Higgin',
        	'numero' => '6',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region del Maule',
        	'numero' => '7',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Concepcion',
        	'numero' => '8',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region del Araucania',
        	'numero' => '9',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region los Lagos',
        	'numero' => '10',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Aysen del General Carlos Ibañes del Campo',
        	'numero' => '11',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Magallanes y de la Antartica Chilena',
        	'numero' => '12',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region Metropolitana',
        	'numero' => '13',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de los Rios',
        	'numero' => '14',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region de Arica y Parinacota',
        	'numero' => '15',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Region del Nuble',
        	'numero' => '16',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);


    }
}
