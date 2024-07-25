<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        //This could be implemented in more sexy way with laravel 11. I forgot in which they changed the factories a bit.
        factory(Client::class, 150)->create();
    }
}
