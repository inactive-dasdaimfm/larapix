<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(20),
            'email' => Str::random(8) . "@gmail.com",
            'password' => Str::random(8),
            'balance' => floatval(25)
        ]);
    }
}
