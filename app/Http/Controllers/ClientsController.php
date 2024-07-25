<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientDestroyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Auth::user()->userClients->each->append('bookings_count');

        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function show($client)
    {
        $client = Client::with('bookings')->where('id', $client)->first();

        //I would prefer to create an API response and load it via Vue or make logic on FE in vue with moment js or similar package
        //this will do for now
        $client->bookings->each->append('time');

        return view('clients.show', ['client' => $client]);
    }

    public function store(Request $request)
    {
        //This is very dangerous, no validation implemented. yet...
        $client = new Client();
        $client->name = $request->get('name');
        $client->email = $request->get('email');
        $client->phone = $request->get('phone');
        $client->address = $request->get('address');
        $client->city = $request->get('city');
        $client->postcode = $request->get('postcode');
        $client->save();

        return $client;
    }

    public function destroy(ClientDestroyRequest $request, Client $client)
    {
        $client->delete();

        return response()->json([], 204);
    }
}
