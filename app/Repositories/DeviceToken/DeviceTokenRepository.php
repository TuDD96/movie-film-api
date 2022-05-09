<?php

namespace App\Repositories\DeviceToken;

use App\Enums\DBConstant;
use App\Models\DeviceToken;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class DeviceTokenRepository extends EloquentRepository implements DeviceTokenRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return DeviceToken::class;
    }

    public function removeToken($request)
    {
        try {
            $token = $request->fcm_token;

            $this->model->where('token', $token)->update(['invalidated_at' => Carbon::now()]);

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function saveToken($userId, $request)
    {
        try {
            $this->model->updateOrCreate(
                [
                    "invalidated_at" => NULL,
                    'token' => $request->fcm_token,
                    'platform' => $request->platform == DBConstant::IOS_PLATFORM ? DBConstant::IOS_PLATFORM : DBConstant::ANDROID_PLATFORM
                ],
                [
                    'user_id' => $userId
                ]
            );

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function findTokenById($id)
    {
        return $this->model->findOrFail($id);
    }
}
