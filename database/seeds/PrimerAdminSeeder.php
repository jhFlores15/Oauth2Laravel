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
        	'rut' => '18887056',
        	'dv' => '2',
        	'razon_social' => 'Johanna Flores',
        	'email' => 'johflores1510@gmail.com',
        	'password' => bcrypt('johflores'),
        	'password_visible' => 'johflores',
        	'rol_id' => 1,
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
    }
}
