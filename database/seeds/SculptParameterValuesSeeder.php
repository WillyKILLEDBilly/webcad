<?php

use Illuminate\Database\Seeder;

class SculptParameterValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $last_m_id = 1;
        //all details
    	for($d_id=1; $d_id<=6; $d_id++){
            //8 models for each detail
            for($m_id=1; $m_id<=8; $m_id++){
                //5 parameters for each detail
                for($p_id=1; $p_id<=5; $p_id++){
                    $dpt = DB::table('detail_has_parameter_type')
                        ->where([
                            ['detail_id', $d_id], 
                            ['parameter_type_id', $p_id]
                        ])
                        ->first();
                    if ($dpt==null) break;
                    DB::table('sculpt_parameter_values')->insert([
                        [
                            'value' => rand(10,300),
                            'sculpt_id' => $last_m_id,
                            'parameter_type_id' => $p_id
                        ]
                    ]);
                }
                $last_m_id++;
            }
        }
    }
}
