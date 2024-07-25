<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Rudolf Bruder',
            'email' => 'rudolf.bruder@gmail.com',
        ]);

        User::factory(20)->create();
    }
}
