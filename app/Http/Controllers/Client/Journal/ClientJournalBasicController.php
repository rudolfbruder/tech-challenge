<?php

namespace App\Http\Controllers\Client\Journal;

use App\Client;
use App\Http\Controllers\Controller;
use App\Journal;

class ClientJournalBasicController extends Controller
{
    public function show(Client $client, Journal $journal)
    {
        return view('clients.journals.show', ['journal' => $journal]);
    }
}
