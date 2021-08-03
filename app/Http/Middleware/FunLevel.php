<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

include_once __DIR__ . '/../Controllers/Common.php';

class FunLevel {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $level = Auth::user()->level;

        if($level == getValueInfo("adminLevel") || $level == getValueInfo("funLevel"))
            return $next($request);

        return Redirect::to(route('profile'));
    }
}
