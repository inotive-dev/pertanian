<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name'	=> 'SA Developer',
            'email'	=> 'dev@inotive.id',
            'kecamatan_id'	=> 1,
            'password'	=> bcrypt('password')
        ]);
    }
}
