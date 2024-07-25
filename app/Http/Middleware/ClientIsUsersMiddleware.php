<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientIsUsersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! isset($request->route()->parameters()['client'])) {
            return abort(403);
        }

        if ($request->route()->parameters()['client']?->user_id != auth()->user()->id) {
            return abort(403);
        }

        return $next($request);
    }
}
