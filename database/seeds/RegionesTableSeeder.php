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
        	'nombre' => 'Tarapaca',
        	'numero' => '1',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('regiones')->insert([
        	'nombre' => 'Antofagasta',
        	'numero' => '2',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Atacama',
        	'numero' => '3',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Coquimbo',
        	'numero' => '4',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Valparaiso',
        	'numero' => '5',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Libertador General Bernardo O´Higgins',
        	'numero' => '6',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Maule',
        	'numero' => '7',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Concepcion',
        	'numero' => '8',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
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
        	'nombre' => 'Magallanes y de la Antartica Chilena',
        	'numero' => '12',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Metropolitana',
        	'numero' => '13',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Los Rios',
        	'numero' => '14',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Arica y Parinacota',
        	'numero' => '15',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('regiones')->insert([
        	'nombre' => 'Ñuble',
        	'numero' => '16',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);


    }
}
