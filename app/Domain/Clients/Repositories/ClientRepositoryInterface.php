<?php

namespace App\Domain\Clients\Repositories;

use Illuminate\Support\Collection;

interface ClientRepositoryInterface
{
    public function getUsersClients(): Collection;
}
