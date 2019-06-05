<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AutorizadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('autorizadores')->insert([
            'nombre' => 'Daniel Muñoz',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);  
        DB::table('autorizadores')->insert([
            'nombre' => 'Patricio Mora',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);     
    }
}
