<?php

namespace App\Models;

use App\Traits\SoftDeletes\CustomSoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use CustomSoftDeletes;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_type',
        'login_type',
        'email',
        'password',
        'remember_token',
        'last_name_kanji',
        'first_name_kanji',
        'last_name_kana',
        'first_name_kana',
        'nickname',
        'sex',
        'date_of_birth',
        'phone',
        'zip_code',
        'prefecture_id',
        'city',
        'subsequent_address',
        'bank_name',
        'branch_name',
        'account_type',
        'account_number',
        'account_last_name',
        'account_first_name',
        'interests',
        'points_balance',
        'points_received',
        'is_authenticated',
        'is_archived',
        'created_at'
    ];

    protected $hidden = ['remember_token', 'password', 'is_archived'];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
