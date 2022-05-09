<?php

namespace App\Http\Middleware;

use Closure;

class checkingToken
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
        if (isset($request->token)) {
            if (auth('client')->check()) {
                $user = auth('api')->setToken($request->token)->user();
                if (is_null($user)) {
                    auth('client')->logout();
                    return $this->redirectLogin($request);
                } else {
                    if ($user->user_id != auth('client')->user()->user_id) {
                        auth('client')->logout();
                        auth('client')->login($user);
                        return $this->redirectHome($request);
                    } else {
                        return $this->redirectHome($request);
                    }
                }
            } else {
                return $this->redirectLogin($request);
            }
        } else {
            return $next($request);
        }
    }

    private function redirectHome($request)
    {
        if (isset($request->league)) {
            return redirect(route('client.home') . "?league=" . $request->league);
        } else {
            return redirect(route('client.home'));
        }
    }
    
    private function redirectLogin($request)
    {
        if (isset($request->league)) {
            return redirect(route('client.login') . "?league=" . $request->league);
        } else {
            return redirect(route('client.login'));
        }
    }
}
