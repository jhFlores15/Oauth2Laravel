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
    	$region = \App\Region::all()->where('numero',9)->first();
        DB::table('comunas')->insert([
        	'nombre' => 'ANGOL',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'CARAHUE',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'NEHUENTUE',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'CHOL CHOL',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'COLLIPULLI',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'CUNCO',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
         DB::table('comunas')->insert([
            'nombre' => 'LAS HORTENCIAS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
          DB::table('comunas')->insert([
            'nombre' => 'LOS LAURELES',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
           DB::table('comunas')->insert([
            'nombre' => 'CURACAUTIN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
            DB::table('comunas')->insert([
            'nombre' => 'MALALCAHUELLO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
             DB::table('comunas')->insert([
            'nombre' => 'CURARREHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
              DB::table('comunas')->insert([
            'nombre' => 'CATRIPULLI',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
               DB::table('comunas')->insert([
            'nombre' => 'ERCILLA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                DB::table('comunas')->insert([
            'nombre' => 'PAILAHUEQUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                 DB::table('comunas')->insert([
            'nombre' => 'FREIRE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);      
          DB::table('comunas')->insert([
            'nombre' => 'QUEPE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
           DB::table('comunas')->insert([
            'nombre' => 'RADAL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
            DB::table('comunas')->insert([
            'nombre' => 'GALVARINO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
             DB::table('comunas')->insert([
            'nombre' => 'GORBEA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
              DB::table('comunas')->insert([
            'nombre' => 'LASTARRIAS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
               DB::table('comunas')->insert([
            'nombre' => 'QUITRATUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                DB::table('comunas')->insert([
            'nombre' => 'IMPERIAL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
         DB::table('comunas')->insert([
            'nombre' => 'LAUTARO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
          DB::table('comunas')->insert([
            'nombre' => 'PILLANLELBUN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
           DB::table('comunas')->insert([
            'nombre' => 'LONCOCHE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
            DB::table('comunas')->insert([
            'nombre' => 'LA PAZ',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
             DB::table('comunas')->insert([
            'nombre' => 'HUISCAPI',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
              DB::table('comunas')->insert([
            'nombre' => 'LONQUIMAY',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
               DB::table('comunas')->insert([
            'nombre' => 'ICALMA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                DB::table('comunas')->insert([
            'nombre' => 'LIUCURA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                 DB::table('comunas')->insert([
            'nombre' => 'LOS SAUCES',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                  DB::table('comunas')->insert([
            'nombre' => 'LUMACO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
                   DB::table('comunas')->insert([
            'nombre' => 'CAPITAN PASTENE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PICHIPELLAHUEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RELUM',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MELIPEUCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'NUEVA IMPERIAL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PADRE LAS CASAS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'METRENCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PERQUENCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PITRUFQUEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'FAJA MAISA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VILLA COMUY',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUCON',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CABURGA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUREN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RENAICO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MININCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'TIJERAL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comunas')->insert([
            'nombre' => 'SAAVEDRA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO DOMINGUEZ',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'TEMUCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LABRANZA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'SAN RAMON (TEM)',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'TROVOLHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'TEODORO SCHMIDT',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'BARROS ARANA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'HUALPIN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
         DB::table('comunas')->insert([
            'nombre' => 'TOLTEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VILLA LOS BOLDOS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'TRAIGUEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VICTORIA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'SELVA OSCURA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VILCUN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CAJON',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CHERQUENCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'GENERAL LOPEZ',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'SAN PATRICIO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VILLARRICA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LICAN RAY',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'TROVOLHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        $region = \App\Region::all()->where('numero',10)->first();

        DB::table('comunas')->insert([
        	'nombre' => 'ANCUD',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'CHACAO',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'BAHIA MANSA',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'CALBUCO',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'PARGUA',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'PULUQUI',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'CASTRO',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
        	'nombre' => 'CHAITEN',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
         DB::table('comunas')->insert([
        	'nombre' => 'SANTA LUCIA',
        	'region_id' => $region->id,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO GUADAL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CHONCHI',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'HUILLINCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'COCHAMO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LLANADA GRANDE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUELO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CURACO DE VELEZ',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'DALCAHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'FRESIA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'TEGUALDA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'FRUTILLAR',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CASMA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'FUTALEUFU',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'HUALAIHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CONTAO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'HORNOPIREN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LLANQUIHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'COLEGUAL GRANDE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LONCOTORO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LOS PELLINES',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LOS MUERMOS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MAULLIN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CARELMAPU',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'QUENUIR',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'OSORNO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CANCURA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CASCADA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CONCORDIA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LAS LUMAS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PICHIL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PALENA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO MONTT',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ALERCE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CALETA LA ARENA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LAS QUEMAS (LOS MUER',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CHAMIZA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO OCTAY',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO VARAS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ENSENADA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'NUEVA BRAUNAU',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PETROHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PEULLA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RALUN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUQUELDON',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PURRANQUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CORTE ALTO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CRUCERO(PURRANQUE)',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'HUEYUSCA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUYEHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ENTRE LAGOS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PILMAIQUEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'QUEILEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'QUELLON',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'QUEMCHI',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'QUINCHAO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ACHAO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RIO TRANQUILO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RIO NEGRO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RIACHUELO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'SAN JUAN DE LA COSTA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MAICOLPUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUAUCHO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUCATRIHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'SAN PABLO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        $region = \App\Region::all()->where('numero',11)->first();

        DB::table('comunas')->insert([
            'nombre' => 'MANIHUALES',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'AYSEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CALETA ANDRADE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ESTERO COPA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO AGUIRRE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO CHACABUCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO RAMIREZ',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CHILE CHICO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MALLIN GRANDE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CISNES',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LA JUNTA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUYUHUAPI',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'COCHRANE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'COYHAIQUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comunas')->insert([
            'nombre' => 'BALMACEDA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VALLE SIMPSON',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VILLA EL BLANCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'GUAITECAS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MELINKA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LAGO VERDE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VILLA TAPERA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'O’HIGGINS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RIO IBAÑEZ',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'BAHIA MURTA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO SANCHEZ',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
         DB::table('comunas')->insert([
            'nombre' => 'VILLA CERRO CASTILLO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'TORTEL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        $region = \App\Region::all()->where('numero',14)->first();

        DB::table('comunas')->insert([
            'nombre' => 'CORRAL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LA UNION',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LOS ESTEROS (LA UNIO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LANCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LOS LAGOS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MAFIL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MARIQUINA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PAILLACO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ARCOIRIS (PAILLACO)',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PANGUIPULLI',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CHOSHUENCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VALDIVIA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'AMARGOS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CAYUMAPU',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'FOLILCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ITROPULLI (PAILLACO)',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LIQUIÑE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comunas')->insert([
            'nombre' => 'LOS MOLINOS',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MALALHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MEHUIN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MELEFQUEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'NELTUME',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'NIEBLA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ÑANCUL',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PELCHUQUIN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PICHIRROPULLI',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO FUY',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUNUCAPA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'QUEULE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'REUMEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RINIHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'VIVANCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'COÑARIPE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'FUTRONO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LAGO RANCO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'RIO BUENO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CAYURRUCA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'CRUCERO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'IGNAO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'LLIFEN',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'MANTILHUE',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'NONTUELA',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'PUERTO NUEVO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ROFUCO ALTO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('comunas')->insert([
            'nombre' => 'ROFUCO BAJO',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
         DB::table('comunas')->insert([
            'nombre' => 'STA ROSA CHICA (PAI',
            'region_id' => $region->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }

    
}
