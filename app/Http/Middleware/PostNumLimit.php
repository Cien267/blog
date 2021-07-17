<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
class PostNumLimit
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
        if ($request->title == 'abc') {
            return $next($request);
        }
        return redirect('home');

    }
}
