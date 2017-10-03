<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$c_id = 1;
        DB::table('details')->insert([
        	[
        		'detail_category_id' => $c_id,
        		'name' => 'Напівкругла увігнута',
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'link_name' => 'napivkrugla-uvignuta',
        		'preview_img' => '/storage/previews/napivkrugla-uvignuta.png',
        		'draw_img' => '/storage/draws/napivkrugla-uvignuta.png'
        	],
        	[
        		'detail_category_id' => $c_id,
        		'name' => 'Напівкругла увігнута тип 2',
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'link_name' => 'napivkrugla-vvignuta-type-2',
        		'preview_img' => '/storage/previews/napivkrugla-uvignuta-type-2.png',
        		'draw_img' => '/storage/draws/napivkrugla-uvignuta-type-2.png'
        	],
        	[
        		'detail_category_id' => $c_id,
        		'name' => 'Напівкругла радіусна',
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        		'link_name' => 'napivkrugla-radiusna',
        		'preview_img' => '/storage/previews/napivkrugla-radiusna.png',
        		'draw_img' => '/storage/draws/napivkrugla-radiusna.png'
        	],
        ]);
    }
}
