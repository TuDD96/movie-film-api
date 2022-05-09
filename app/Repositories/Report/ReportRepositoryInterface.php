<?php

declare(strict_types=1);

namespace App\Repositories\Report;

use App\Repositories\EloquentRepositoryInterface;

interface ReportRepositoryInterface extends EloquentRepositoryInterface
{
    public function store($bookId, $currentUser, $comment);
}
