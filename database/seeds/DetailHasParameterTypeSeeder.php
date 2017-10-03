<?php

use Illuminate\Database\Seeder;

class DetailHasParameterTypeSeeder extends Seeder
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
    		//all parameter types
    		for ($pt_id = 1; $pt_id < 6; $pt_id++){
    			//don't let set radius to not angle cutters 
    			if ($d_id<4 && $pt_id==5) break;

    			DB::table('detail_has_parameter_type')->insert([
		        	[
		        		'parameter_type_id' => $pt_id,
		        		'detail_id' => $d_id
		        	]
		        ]);
    		}
	}
}
