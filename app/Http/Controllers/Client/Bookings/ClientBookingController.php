<?php

namespace App\Http\Controllers\Client\Bookings;

use App\Booking;
use App\Client;

use function App\Helpers\currentUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Client\ClientDestroyRequest;
use App\Http\Resources\Client\Booking\ClientBookingsResource;
use Exception;

class ClientBookingController extends Controller
{
    public function index(Client $client)
    {
        if ($client->user_id != currentUser()->id) {
            throw new Exception("Unauthorized", 403);
        }

        switch (request()->type) {
            case 'future':
                $collection = Booking::where('client_id', $client->id)->where('start', '>', now())->paginate();

                break;
            case 'past':
                $collection = Booking::where('client_id', $client->id)->where('end', '<', now())->paginate();

                break;
            case 'all':
                $collection = Booking::where('client_id', $client->id)->paginate();

                break;
            default:
                $collection = Booking::where('client_id', $client->id)->paginate();

                break;
        }

        return  ClientBookingsResource::collection($collection);
    }

    public function destroy(ClientDestroyRequest $request, Client $client, Booking $booking)
    {
        $booking->delete();

        return response()->json([], 204);
    }
}
