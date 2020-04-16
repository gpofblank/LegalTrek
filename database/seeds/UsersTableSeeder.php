<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'id' => '1',
        		'name' => 'Atanas Mihnev',
        		'email' => 'user1@example.com',
        		'email_verified_at' => now(),
        		'password' => Hash::make('password'),
        		'remember_token' => 'qweasdzxcqweasdz',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'id' => '2',
        		'name' => 'Elvis Metodiev',
        		'email' => 'user2@example.com',
        		'email_verified_at' => now(),
        		'password' => Hash::make('password'),
        		'remember_token' => 'qweasdzxcqweasdz',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'id' => '3',
        		'name' => 'Hristofor Todorov',
        		'email' => 'user3@example.com',
        		'email_verified_at' => now(),
        		'password' => Hash::make('password'),
        		'remember_token' => 'qweasdzxcqweasdz',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        ]);
    }
}
