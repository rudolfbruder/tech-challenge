<?php

namespace App\Http\Controllers;

use App\Client;

use function App\Helpers\currentUser;

use App\Http\Requests\Frontend\Client\ClientDestroyRequest;
use App\Http\Requests\Frontend\Client\ClientStoreRequest;

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

    public function show(Client $client)
    {
        if ($client->user->id != currentUser()->id) {
            abort(403, "You are unauthorized to view this client");
        }
        $client->load('bookingsOrderByNewest');
        //I would prefer to create an API response and load it via Vue or make logic on FE in vue with moment js or similar package
        //this will do for now
        $client->bookingsOrderByNewest->each->append('time');

        return view('clients.show', ['client' => $client]);
    }

    public function store(ClientStoreRequest $request)
    {
        $client = currentUser()?->userClients()->create($request->validated());

        return $client;
    }

    public function destroy(ClientDestroyRequest $request, Client $client)
    {
        $client->delete();

        return response()->json([], 204);
    }
}
