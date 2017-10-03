<?php

use Illuminate\Database\Seeder;

class SculptsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//all details
    	for($d_id = 1; $d_id < 7; $d_id++)
    		//8 sculpts to each detail
    		for($i = 1; $i < 9; $i++)
        		DB::table('sculpts')->insert([
        			['detail_id' => $d_id, 'showing_model' => 'storage/models/m'.$i.'html']
        		]);
    }
}
