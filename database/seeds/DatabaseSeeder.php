<?php

use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(BookingSeeder::class);
    }
}
