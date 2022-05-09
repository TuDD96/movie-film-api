<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\SoftDeletes\CustomSoftDeletes;
use App\Enums\DBConstant;
use App\Enums\Constant;

class ManagementPortalUser extends Authenticatable
{
	use CustomSoftDeletes;

    protected $table = 'mgmt_portal_users';
	
    protected $primaryKey = 'mgmt_portal_user_id';

    protected $hidden = ['remember_token', 'password', 'is_archived'];

    protected $fillable = [
        'email',
        'password',
        'remember_token',
        'is_archived',
    ];
}
