<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Exception;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $link = $this->getFullDomain();
            
        if (strpos($link, route('client.home')) !== false) {
            try {
                if (isset($request->token)) {
                    $user = auth('api')->setToken($request->token)->user();
                    if (is_null($user)) {
                        return $this->redirectLogin($request);
                    } else {
                        auth('client')->login($user);
                        return $this->redirectHome($request);
                    }
                } else {
                    return $this->redirectLogin($request);
                }
            } catch (Exception $e) {
                return $this->redirectLogin($request);
            }
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    protected function redirectHome($request)
    {
        if (isset($request->league)) {
            return route('client.home') . "?league=" . $request->league;
        } else {
            return route('client.home');
        }
    }
    
    protected function redirectLogin($request)
    {
        if (isset($request->league)) {
            return route('client.login') . "?league=" . $request->league;
        } else {
            return route('client.login');
        }
    }

    protected function getFullDomain()
    {
        if (strpos(route('client.home'), "https://") !== false) {
            $link = "https://";
        } else {
            $link = "http://";
        }
        $link .= $_SERVER['HTTP_HOST'];
        $link .= $_SERVER['REQUEST_URI'];

        return $link;
    }
}

