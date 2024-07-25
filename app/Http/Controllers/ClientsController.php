<?php

namespace App\Http\Controllers;

use App\Client;
use App\Domain\Clients\Repositories\ClientRepositoryInterface;

use function App\Helpers\currentUser;

use App\Http\Requests\Frontend\Client\ClientStoreRequest;

class ClientsController extends Controller
{
    public function index(ClientRepositoryInterface $clientRepository)
    {
        $clients = $clientRepository->getUsersClients();

        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function show(Client $client)
    {
        // could also be done as in index method via repository
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
}
