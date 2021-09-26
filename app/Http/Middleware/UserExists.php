<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserExists
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
        $body = $request->json()->all();

        $user = DB::table('users')
            ->select('users.*')
            ->where('users.email', '=', strtolower($body['email']))
            ->get();

        if ($user)
        {
            return response('Email already exists');
        }

        return $next($request);
    }
}
