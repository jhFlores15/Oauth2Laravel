<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ComunasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tarapaca = \App\Region::all()->where('numero',1);
        DB::table('comunas')->insert([
        	'nombre' => 'Iquique',
        	'region_id' => $tarapaca,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Alto Hospicio',
        	'region_id' => $tarapaca,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Pozo Almonte',
        	'region_id' => $tarapaca,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Camiña',
        	'region_id' => $tarapaca,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Huara',
        	'region_id' => $tarapaca,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Pica',
        	'region_id' => $tarapaca,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);


        $antofagasta = \App\Region::all()->where('numero',2);
        DB::table('comunas')->insert([
        	'nombre' => 'Antofagasta',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Mejillones',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Sierra Gorda',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Taltal',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Calama',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Ollagüe',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'San Pedro de Atacama',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'Tocopilla',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
         DB::table('comunas')->insert([
        	'nombre' => 'María Elena',
        	'region_id' => $antofagasta,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

         $atacama = \App\Region::all()->where('numero',3);
         DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
          DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
           DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
            DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
             DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
              DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
               DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
                DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
                 DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
                  DB::table('comunas')->insert([
        	'nombre' => '',
        	'region_id' => $atacama,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

    }
}
