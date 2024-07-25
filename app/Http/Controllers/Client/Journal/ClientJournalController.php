<?php

namespace App\Http\Controllers\Client\Journal;

use App\Client;

use function App\Helpers\currentUser;

use App\Http\Controllers\Controller;

use App\Journal;
use Exception;
use Illuminate\Http\Request;

class ClientJournalController extends Controller
{
    public function index(Client $client)
    {
        return response()->json([
            'data' => $client->journals,
        ]);
    }

    //Again i would use custom request as in other controllers, for the sake of time just a comment
    public function store(Request $request)
    {
        $journal = Journal::create([
            'written_at' => $request->written_at,
            'content' => $request->content,
            'user_id' => currentUser()->id,
            'client_id' => $request->client_id,
        ]);

        return response()->json(['id' => $journal->id], 201);
    }

    public function destroy(Client $client, Journal $journal)
    {
        //Again i would use custom request as in other controllers, for the sake of time just a comment
        if ($client->user_id != currentUser()->id) {
            throw new Exception('Unauthorized', 403);

        }
        $journal->delete();

        return response()->json([], 204);
    }
}
