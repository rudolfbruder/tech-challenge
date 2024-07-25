<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class)->create([
            'name' => 'Rudolf Bruder',
            'email' => 'rudolf.bruder@gmail.com',
        ]);

        factory(User::class, 20)->create();
    }
}
