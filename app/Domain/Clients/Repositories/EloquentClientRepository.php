<?php

namespace App\Domain\Clients\Repositories;

use function App\Helpers\currentUser;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class EloquentClientRepository implements ClientRepositoryInterface
{
    public function getUsersClients(): Collection
    {
        return currentUser()->userClients->each->append('bookings_count');

        //We could implement caching and then observers to clear the cache upon changes / removals and other actions
        $userClients = Cache::remember('user_id_' . currentUser()->id . '_clients', config('cache.durations.hour'), function () {
            return currentUser()->userClients->each->append('bookings_count');
        });

        return $userClients;
    }
}
