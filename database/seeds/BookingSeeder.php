<?php

use App\Booking;
use App\Client;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        //useless line and foreach loop, let's do it the collection way.
        // $clients = Client::all();

        // foreach ($clients as $client) {
        //     $numberOfBookings = rand(0, 30);

        //     factory(Booking::class, $numberOfBookings)->create([
        //         'client_id' => $client->id,
        //     ]);
        // }

        //4 lines vs 7+
        Client::all()->each(function (Client $client): void {
            factory(Booking::class, rand(0, 30))->create([
                'client_id' => $client->id,
            ]);
        });

        //If you would like to have more variable bookings created we could also use Client::inRandomOrder()->each
        //Also Client::all() is doable now but in case you would have seeder with more / thousands of records, chunkById is better approach
        //so that you won't get memory limit exceptions by php in rare cases in case you objects are super big.
    }
}
