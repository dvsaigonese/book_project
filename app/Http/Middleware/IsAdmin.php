<?php

namespace App\Http\Middleware;

use App\Models\Position;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user) {
            $position = Position::where('id', $user->position_id)->first()->name;

            if ($position == 'admin') {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
