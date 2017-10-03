<?php

use Illuminate\Database\Seeder;

class ParameterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameter_types')->insert([
        	['name' => 'R', 'dimention' => 'mm'],
        	['name' => 'D', 'dimention' => 'mm'],
        	['name' => 'L', 'dimention' => 'mm'],
        	['name' => 'd', 'dimention' => 'mm'],
        ]);
    }
}
