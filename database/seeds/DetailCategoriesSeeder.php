<?php

use Illuminate\Database\Seeder;

class DetailCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_categories')->insert([
            ['name' => 'Фреза']
        ]);
    }
}
