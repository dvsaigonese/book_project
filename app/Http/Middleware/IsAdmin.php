<?php

namespace App\Http\Middleware;

use App\Models\Position;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = DB::table('model_has_roles')
            ->where('model_has_roles.model_id', auth()->user()->id)
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', '=', 'Super-Admin')
            ->get();

        if ($role_id) {
            return $next($request);
        }

        return redirect('/');
    }
}
