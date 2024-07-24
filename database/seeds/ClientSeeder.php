<?php

use App\Client;
use App\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        //This could be implemented in more sexy way with laravel 11. I forgot in which they changed the factories a bit.
        // $user = User::first() ?? factory(User::class)->create();
        factory(Client::class, 150)->create([
            // 'user_id' => $user->id,
        ]);
    }
}
