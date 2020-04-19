<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
        	[
        		'id' => '1',
        		'currency' => 'Euro',
        	],
        	[
        		'id' => '2',
        		'currency' => 'US dollars',
        	]
        ]);
    }
}
