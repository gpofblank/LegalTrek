<?php

use Illuminate\Database\Seeder;

class MattersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Matter::class, 10)->create();
    }
}
