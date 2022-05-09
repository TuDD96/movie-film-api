<?php

namespace App\Http\Middleware;

use App\Enums\ErrorType;
use Closure;
use Illuminate\Http\JsonResponse;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ApiMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected function sendError($code = 5000, $status = null, $message = null): JsonResponse
    {
        $response = [
            'error' => [
                'code' => (int)$code,
                'status' => $status,
                'message' => $message,
            ],
        ];

        return response()->json($response);
    }

    public function handle($request, Closure $next)
    {
        try {
            $user = auth('api')->user();

            if($user == false) {
                return $this->sendError(ErrorType::CODE_4010, ErrorType::STATUS_4010, trans('errors.MSG_4010'));
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->sendError(ErrorType::CODE_4012, ErrorType::STATUS_4012, trans('errors.MSG_4012'));
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->sendError(ErrorType::CODE_4011, ErrorType::STATUS_4011, trans('errors.MSG_4011'));
            } else {
                return $this->sendError(ErrorType::CODE_4010, ErrorType::STATUS_4010, trans('errors.MSG_4010'));
            }
        }

        return $next($request);
    }
}
