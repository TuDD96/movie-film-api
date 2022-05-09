<?php

declare(strict_types=1);

namespace App\Repositories\Report;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Models\Report;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportRepository extends EloquentRepository implements ReportRepositoryInterface
{
    /**
     * get model.
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Report::class;
    }

    public function store($bookId, $currentUser, $comment)
    {
        $attr = [
            'user_id' => $currentUser,
            'book_id' => $bookId,
            'comment' => $comment
        ];

        return $this->model->create($attr);
    }
}
