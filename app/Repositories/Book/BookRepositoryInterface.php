<?php

namespace App\Repositories\Book;

use App\Repositories\EloquentRepositoryInterface;

interface BookRepositoryInterface extends EloquentRepositoryInterface
{
    public function getList($filters, $limit, $sorts);

    public function getUnHiddenBook($id);

    public function getListComic($page, $limit, $userId, $bookLeagues, $blockBooks);

    public function getSearchData($keyword);

    public function getBookOfUser($userId);

    public function getUnHiddenBookOfUser($userId);

    public function getByUserId($userId);

    public function getByMultiUser($userIds);
}
