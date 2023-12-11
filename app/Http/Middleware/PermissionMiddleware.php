<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Auth;

class PermissionMiddleware
{
    
    public function handle($request, Closure $next, $permission = null)
    {
        $user = Auth::user();
        if (isset($user->id)) {

            if (in_array($user->roles[0]->id, [1, 2, 3])) {
                // Ok
            } else {
                // Jopa
                throw UnauthorizedException::forPermissions([$permission]);
            }
        } else {
            // return redirect()->route('login');
            throw UnauthorizedException::notLoggedIn();
        }




        return $next($request);
    }
}