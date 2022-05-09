<?php

namespace App\Traits;

use Illuminate\Support\Collection as BaseCollection;
use App\Enums\ErrorType;

trait ResponseApiHandle {

    public function responseSuccess(array $data = [], string $msg = null)
    {
        return response()
            ->json([
                'data' => $data, 
                'msg' => $msg ?? __('message.success')
            ], 200);
    }

    public function responseError($msg = null)
    {
        $response = [
            'error' => [
                'code' => (int)ErrorType::CODE_4220,
                'message' => $msg ?? __('message.fail')
            ]
        ];
        return response()->json($response, ErrorType::STATUS_4220);
    }
}