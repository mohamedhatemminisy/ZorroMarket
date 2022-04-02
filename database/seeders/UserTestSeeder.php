<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'admin',
            'email'  => 'admin@gmail.com',
            'phone'  => '01020828482',
            'password'  => bcrypt('12345678'),

       ]);
    }
}
