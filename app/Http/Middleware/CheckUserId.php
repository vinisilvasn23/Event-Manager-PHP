<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserId
{
    public function handle(Request $request, Closure $next)
    {
        $userIdFromToken = $request->user_id;

        $userIdFromRoute = $request->route('id');
        if ($userIdFromToken !== $userIdFromRoute) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
