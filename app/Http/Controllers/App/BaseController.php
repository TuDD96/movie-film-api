<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseApiHandle;
use Auth;

class BaseController extends Controller
{
    use ResponseApiHandle;

    /**
     * Get guard
     *
     * @param $guardName
     * @return void
     */
    protected function getGuard($guardName = 'api')
    {
        return Auth::guard($guardName);
    }

    /**
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    protected function sendSuccess($data = null, $message = null): JsonResponse
    {
        $response = [
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    protected function sendError($code = 5000, $statusCode = 500, $message = null): JsonResponse
    {
        $response = [
            'error' => [
                'code' => (int)$code,
                'message' => $message,
            ],
        ];

        return response()->json($response, $statusCode);
    }
}
