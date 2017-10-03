<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call(ParameterTypesSeeder::class);
        $this->call(DetailCategoriesSeeder::class);
        $this->call(DetailsSeeder::class);
        $this->call(DetailHasParameterTypeSeeder::class);
        $this->call(SculptsSeeder::class);*/
        $this->call(SculptParameterValuesSeeder::class);
    }
}