<?php

namespace App\Http\Middleware;

use App\models\ConfigModel;
use Closure;
use Illuminate\Support\Facades\Redirect;

class FriendAvailibility
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
        if(!ConfigModel::first()->friendAvailibility)
            return Redirect::route('profile');

        return $next($request);
    }
}
