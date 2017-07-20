<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
      if($request->session()->get('status') === null){ //if no status
            return redirect('/login');
      }
      else{ // if status is set
        return $next($request);
      }
    }
}
