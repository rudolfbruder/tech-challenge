<?php

namespace App\Http\Controllers\Client\Journal;

use App\Client;
use App\Http\Controllers\Controller;
use App\Journal;

class ClientJournalBasicController extends Controller
{
    public function show(Client $client, Journal $journal)
    {
        //View could be done vuejs or as SPA however you wish. for the sake of time I just write the comment.
        return view('clients.journals.show', ['journal' => $journal]);
    }
}
