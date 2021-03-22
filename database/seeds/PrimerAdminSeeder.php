<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PrimerAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
       
         DB::table('users')->insert([
            'rut' => '15283955',
            'dv' => '3',
            'razon_social' => 'Daniel Muñoz',
            'email' => 'daniel.munoz@dimak.cl',
            'password' => bcrypt('dimak2019'),
            'password_visible' => 'dimak2019',
            'rol_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
