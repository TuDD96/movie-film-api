<?php

namespace App\Repositories\TransferHistory;

use App\Repositories\EloquentRepositoryInterface;

interface TransferHistoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function getList($filters, $limit, $sorts);
}
