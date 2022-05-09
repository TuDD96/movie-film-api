<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Enums\DBConstant;

class RolePortal
{
    public function handle($request, Closure $next, ... $roleNames)
    {
        $managementPortalUser = Auth::user();

        foreach($roleNames as $roleName) {
            if($managementPortalUser->hasRole($roleName)) {
                return $next($request);
            }
        }

        abort(403);
    }
}
