<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Mateus',
            'email' => 'mateus-chineis@live.com',
            'password'  => bcrypt('1234'),
            'biography' => 'Mateus souza da rocha',
        ]);
    }
}
