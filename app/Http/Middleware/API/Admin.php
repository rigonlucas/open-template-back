<?php

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userPermission = Auth::user()->permissions->where('permission', 'admin');
        if($userPermission->count() == 0){
            return response()->json(['message' => 'unauthorized'], 401);
        }
        return $next($request);
    }
}
