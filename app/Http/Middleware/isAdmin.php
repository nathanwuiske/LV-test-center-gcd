<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userID = Auth::id();
        $user = User::find($userID);

        if($user->type == "admin"){
            return $next($request);
        }
       return redirect('/');
    }
}
