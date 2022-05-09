<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\DBConstant;
use App\Mail\Portal\SendMailRegisterClientUser;
use App\Repositories\ManagementPortalUser\ManagementPortalUserRepositoryInterface;
use App\Repositories\EmailAuthn\EmailAuthnRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Cookie;

class ManagementPortalUserService
{
    protected $managementPortalUserRepository;
    protected $emailAuthnRepository;

    public function __construct(
        ManagementPortalUserRepositoryInterface $managementPortalUserRepository,
        EmailAuthnRepositoryInterface $emailAuthnRepository
    ) {
        $this->managementPortalUserRepository = $managementPortalUserRepository;
        $this->emailAuthnRepository = $emailAuthnRepository;
    }

    public function getUserByEmail($email)
    {
        return $this->managementPortalUserRepository->getUserByEmail($email);
    }

    public function getUserByClientId($clientId)
    {
        return $this->managementPortalUserRepository->getUserByClientId($clientId);
    }

    public function updatePassword($userId, $password)
    {
        $data = [
            'password' => bcrypt($password)
        ];

        return $this->managementPortalUserRepository->update($userId, $data);
    }

    public function getUserByTokenRefresh($userId)
    {
        return $this->managementPortalUserRepository->getUserByTokenRefresh($userId);
    }

    public function changePassword($request)
    {
        try {
            $data = $request->only([
                'password_current',
                'password_new',
            ]);
            if(!Hash::check($data['password_current'], Auth::user()->password)){
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_4015')
                ];
            }
            $this->managementPortalUserRepository->updatePassword(Auth::user()->mgmt_portal_user_id,$data['password_new']);

            return [
                'success' => true,
                'msg' => trans('message.change_password')
            ];
        } catch (Exception $exception) {
            return [
                'success' => false,
                'msg' => trans('errors.MSG_4015')
            ];
        }
    }

    public function deleteMgmtPortalUser($id)
    {
        return $this->managementPortalUserRepository->delete($id);
    }

    public function update($id, $data)
    {
        return $this->managementPortalUserRepository->update($id, $data);
    }

    public function registerMgmtPortalUser($data)
    {
        $data['name'] = $data['mgmt_portal_user_name'];
        unset($data['mgmt_portal_user_name']);
        $data['user_type'] = DBConstant::MGMT_PORTAL_USER_TYPE_CLIENT_USER;
        $data['is_authenticated'] = DBConstant::MGMT_PORTAL_USER_EMAIL_AUTHN_NOT_AUTHENTICATED;
        $this->managementPortalUserRepository->create($data);
        $token = Str::random(64);
        $dataEmailAuth = [
            'user_type' => DBConstant::MGMT_PORTAL_USER_TYPE_CLIENT_USER,
            'email' => $data['email'],
            'token' => $token,
        ];
        $this->emailAuthnRepository->create($dataEmailAuth);
        $url = url(sprintf(route('register-client-user.edit'). '?token=' . $token));
        Mail::to($data['email'])->queue(new SendMailRegisterClientUser($url));
    }

    public function updateByClientId($id, $dataPortal)
    {
        return $this->managementPortalUserRepository->updateByClientId($id, $dataPortal);
    }

    public function deleteUserByClientId($clientId)
    {
        return $this->managementPortalUserRepository->deleteUserByClientId($clientId);
    }
}
