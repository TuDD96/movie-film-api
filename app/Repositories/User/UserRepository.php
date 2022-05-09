<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Models\User;
use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * get model.
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function getList($filters, $limit, $sorts)
    {
        $query = $this->model->select('users.*', 'p.name')
                            ->leftJoin('prefectures as p', 'p.prefecture_id', 'users.prefecture_id')
                            ->where('users.is_authenticated', DBConstant::IS_AUTHENTICATED_AUTHENTICATED);

        foreach ($filters as $key => $where) {
            if ($where['value'] === '') {
                continue;
            }
            if ($where['where'] == 'like') {
                $query = $query->where($key, 'like', '%' . $where['value'] . '%');
            } elseif ($where['where'] == '=') {
                $query = $query->where($key, '=', $where['value']);
            }
        }

        if (isset($sorts)) {
            if (isset($sorts['user_id'])) {
                $query->orderBy('users.user_id', $sorts['user_id']);
            }
            if (isset($sorts['email'])) {
                $query->orderBy('users.email', $sorts['email']);
            }
            if (isset($sorts['name_kanji'])) {
                $query->orderBy('users.last_name_kanji', $sorts['name_kanji']);
            }
            if (isset($sorts['name_kana'])) {
                $query->orderBy('users.last_name_kana', $sorts['name_kana']);
            }
            if (isset($sorts['nickname'])) {
                $query->orderBy('users.nickname', $sorts['nickname']);
            }
            if (isset($sorts['sex'])) {
                $query->orderBy('users.sex', $sorts['sex']);
            }
            if (isset($sorts['date_of_birth'])) {
                $query->orderBy('users.date_of_birth', $sorts['date_of_birth']);
            }
            if (isset($sorts['phone'])) {
                $query->orderBy('users.phone', $sorts['phone']);
            }
            if (isset($sorts['zip_code'])) {
                $query->orderBy('users.zip_code', $sorts['zip_code']);
            }
            if (isset($sorts['address'])) {
                $query->orderBy('p.name', $sorts['address'])->orderBy('users.city', $sorts['address'])->orderBy('users.subsequent_address', $sorts['address']);
            }
            if (isset($sorts['points_balance'])) {
                $query->orderBy('users.points_balance', $sorts['points_balance']);
            }
            if (isset($sorts['points_received'])) {
                $query->orderBy('users.points_received', $sorts['points_received']);
            }
            if (isset($sorts['created_at'])) {
                $query->orderBy('users.created_at', $sorts['created_at']);
            }

        } else {
            $query->orderBy('users.created_at', Constant::ORDER_BY_DESC);
        }

        $limit = $limit ?? Constant::DEFAULT_LIMIT;

        return $query->paginate($limit);
    }

    public function getEmailAuthenUser()
    {
        return $this->model->where('is_authenticated', DBConstant::IS_AUTHENTICATED_AUTHENTICATED)->pluck('email')->toArray();
    }

    public function getUserByEmail($email)
    {
        return $this->model::where('email', $email)->first();
    }

    public function getUserByTokenRefresh($userId)
    {
        $user = $this->model::where('user_id',$userId)->latest()->first();

        return $user;
    }

    public function verifyUser($userId)
    {
        return $this->model
            ->where("user_id", $userId)
            ->where("is_authenticated", DBConstant::IS_AUTHENTICATED_AUTHENTICATED)
            ->where("is_archived", DBConstant::IS_NOT_ARCHIVED)
            ->first();
    }

    public function getUser($userId)
    {
        return $this->model->where('user_id', $userId)->where('is_authenticated', 1)->where('is_archived', 0)->first();
    }
}
