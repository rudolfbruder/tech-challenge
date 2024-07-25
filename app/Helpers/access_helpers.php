<?php

namespace App\Helpers;

use App\User;

function currentUser(): ?User
{
    return auth()->user() ?? null;
}
