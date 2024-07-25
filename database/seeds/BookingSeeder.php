<?php

use App\Booking;
use App\Client;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Client::all()->each(function (Client $client): void {
            Booking::factory(rand(0, 30))->create([
                'client_id' => $client->id,
            ]);
        });
    }
}
