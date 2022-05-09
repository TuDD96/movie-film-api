<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\RefreshToken\RefreshTokenRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\EmailAuthn\EmailAuthnRepositoryInterface;
use Exception;
use Illuminate\Support\Str;

class UserService extends BaseService
{
    protected $userRepository;
    protected $emailAuthnRepository;
    protected $refreshTokenRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EmailAuthnRepositoryInterface $emailAuthnRepository,
        RefreshTokenRepositoryInterface $refreshTokenRepository
    ) {
        $this->userRepository = $userRepository;
        $this->emailAuthnRepository = $emailAuthnRepository;
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    public function searchPagination($params)
    {
        $filters = [
            'users.user_id' => [
                'where' => '=',
                'value' => null,
            ],
            'users.nickname' => [
                'where' => 'like',
                'value' => null,
            ],
            'users.email' => [
                'where' => 'like',
                'value' => null,
            ]
        ];
        $filters['users.user_id']['value'] = $params['user_id'] ?? '';
        $filters['users.nickname']['value'] = $params['nickname'] ?? '';
        $filters['users.email']['value'] = $params['email'] ?? '';

        $limit = $params['limit'] ?? Constant::DEFAULT_LIMIT;
        $sorts = $params['sort'] ?? '';
        $data = $this->userRepository->getList($filters, $limit, $sorts);
        foreach ($data as $key => $user) {
            $user->phone = $this->convertPhone($user);
        }

        return $data;
    }

    public function createUser($params)
    {
        DB::beginTransaction();

        try {
            $params['password'] = Hash::make($params['password']);
            $params['user_type'] = DBConstant::USER_TYPE_GENERAL_USER;
            $params['login_type'] = DBConstant::LOGIN_TYPE_EMAIL;
            $params['points_balance'] = 0;
            $params['points_received'] = 0;
            $params['is_authenticated'] = DBConstant::IS_AUTHENTICATED_NOT_AUTHENTICATED;
            $user = $this->userRepository->create($params);

            if ($user) {
                $oldEmailAuth = $this->emailAuthnRepository->getByEmail($params['email']);

                if ($oldEmailAuth) {
                    $this->emailAuthnRepository->delete($oldEmailAuth->id);
                }

                $resetToken = Str::random(40);
                $userType = DBConstant::USER_TYPE_GENERAL_USER;
                $this->emailAuthnRepository->create([
                    'user_type' => $userType,
                    'email' => $params['email'],
                    'token' => $resetToken
                ]);

                DB::commit();

                return [
                    'user' => $user,
                    'resetToken' => $resetToken
                ];
            }

            return false;
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    public function updateAuthenticated($userId, $emailAuth)
    {
        try {
            DB::beginTransaction();
            $this->userRepository->update($userId, ['is_authenticated' => DBConstant::IS_AUTHENTICATED_AUTHENTICATED]);
            $this->emailAuthnRepository->delete($emailAuth->id);
            DB::commit();

            return true;
        } catch (Exception $exception) {
            DB::rollback();
            throw $exception;
        }
    }

    public function updatePassword($userId, $password)
    {
        $data = [
            'password' => bcrypt($password)
        ];

        return $this->userRepository->update($userId, $data);
    }

    public function getUserByTokenRefresh($userId)
    {
        return $this->userRepository->getUserByTokenRefresh($userId);
    }

    public function generateRefreshToken($userId)
    {
        $refreshToken = Str::random(40);
        $encryptedRefreshToken = hash('sha256', $refreshToken);
        $refreshTokenEntity = $this->refreshTokenRepository->create([
            'user_id' => $userId,
            'encrypted_refresh_token' => $encryptedRefreshToken,
            'expires_in' => (new Carbon())->addMinute(config('auth.refresh_token_expires')),
            'is_blacklisted' => DBConstant::IS_NOT_BLACKLISTED,
        ]);

        return $refreshToken;
    }

    public function convertPhone($user)
    {
        if ($user->phone != null) {
            $firstPhone = substr($user->phone, 0, 3);
            $bodyPhone = substr($user->phone, 3, 4);
            $lastPhone = substr($user->phone, 7, 4);
            $phone = $firstPhone . "-" . $bodyPhone . "-" . $lastPhone;

            return $phone;
        }

        return null;
    }

    // public function convertZipCode($user)
    // {
    //     if ($user->zip_code != null) {
    //         $firstZC = substr($user->zip_code, 0, 3);
    //         $lastZC = substr($user->zip_code, 3, 4);

    //         $zipCode = $firstZC . "-" . $lastZC;

    //         return $zipCode;
    //     }

    //     return null;
    // }

    public function registerBank($userId, $data)
    {
        try {
            $this->userRepository->update($userId, $data);

            return true;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function updateProfileUser($userId, $profileData)
    {
        return $this->userRepository->update($userId, $profileData);
    }

    public function checkUser($email)
    {
        $user = $this->userRepository->getUserByEmail($email);
        if (is_null($user)) return true;

        return $user->is_authenticated == 1;
    }
}
