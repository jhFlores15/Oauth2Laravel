<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TipoEncuestasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_encuesta')->insert([
        	'nombre' => 'Presencia',
        	'descripcion' => 'Se investiga la existencia de productos',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

          DB::table('tipo_encuesta')->insert([
        	'nombre' => 'Cliente',
        	'descripcion' => 'Se recopilan datos sobre clientes del club',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);


          DB::table('tipo_encuesta')->insert([
          'nombre' => 'Precio',
          'descripcion' => 'Se recopilan datos sobre el precio de los productos',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
            DB::table('tipo_encuesta')->insert([
          'nombre' => 'Estandar',
          'descripcion' => 'Se recopilan datos segun se requiera',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
    }
}
