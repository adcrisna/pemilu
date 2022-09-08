<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        $level_user = Auth::user()->level;
        if($level_user != $level)
        {
            if($level_user == '1')
            {
                return \Redirect::to('/admin/home');
            }
            else
            {
                return \Redirect::to('/pemilih/home');
            }
        }
        return $next($request);
    }
}
