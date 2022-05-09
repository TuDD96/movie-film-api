<?php

namespace App\Repositories\UserGift;

use App\Repositories\EloquentRepositoryInterface;

interface UserGiftRepositoryInterface extends EloquentRepositoryInterface
{
	public function getList($id, $page, $limit);

	public function getByUserId($userId, $userGiftId);
}
