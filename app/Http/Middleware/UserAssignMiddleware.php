<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Tender;
use Illuminate\Support\Facades\Auth;

class UserAssignMiddleware
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
        $tender= Tender::all();



        if(Auth::user()->id != $tender->user_id){

            return $next($request);
        }
        return redirect('/');


    }
}
