<?php

namespace App\Repositories\Book;

use App\Enums\DBConstant;
use App\Models\Book;
use App\Repositories\EloquentRepository;
use App\Enums\Constant;
use Illuminate\Support\Facades\DB;

class BookRepository extends EloquentRepository implements BookRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Book::class;
    }

    public function getList($filters, $limit, $sorts)
    {
        $query = $this->model->select(
            'books.*',
            'e.title as event_title',
            'blm.league_id');
        
        if ($filters['blm.league_id']['value'] == '') {
            $query = $query->leftJoin('book_league_mappings as blm', function ($leftJoin) {
                $leftJoin->on('blm.league_id', DB::raw("(select league_id from book_league_mappings blm2 where books.book_id = blm2.book_id order by created_at asc limit 1)"))
                         ->on('blm.book_id', DB::raw("(select book_id from book_league_mappings blm3 where books.book_id = blm3.book_id order by created_at asc limit 1)"));
            });
        } else {
            $query = $query->leftJoin('book_league_mappings as blm', 'blm.book_id', 'books.book_id');
        }

        $query = $query->leftJoin('leagues as l', 'l.league_id', 'blm.league_id')
                       ->leftJoin('events as e', 'e.event_id', 'l.event_id')
                       ->join('users as u', 'u.user_id', 'books.user_id')
                       ->where('u.is_authenticated', DBConstant::IS_AUTHENTICATED_AUTHENTICATED)
                       ->where('u.is_archived', DBConstant::NOT_ARCHIVED_FLAG);

        foreach ($filters as $key => $where) {
            if ($where['value'] === '') {
                continue;
            }
            if ($where['where'] == 'like') {
                if ($key == 'books.title') {
                    $query = $query->where($key, 'like', $where['value'] . '%');
                } else {
                    $query = $query->where($key, 'like', '%' . $where['value'] . '%');
                }
            } elseif ($where['where'] == '=') {
                $query = $query->where($key, '=', $where['value']);
            }
        }

        if (isset($sorts)) {
            if (isset($sorts['book_id'])) {
                $query->orderBy('books.book_id', $sorts['book_id']);
            }
            if (isset($sorts['user_id'])) {
                $query->orderBy('books.user_id', $sorts['user_id']);
            }
            if (isset($sorts['title'])) {
                $query->orderBy('books.title', $sorts['title']);
            }
            if (isset($sorts['league_id'])) {
                $query->orderBy('l.league_id', $sorts['league_id']);
            }
            if (isset($sorts['event_title'])) {
                $query->orderBy('e.title', $sorts['event_title']);
            }
        }

        return $query->paginate($limit);
    }

    public function getUnHiddenBook($id)
    {
        return $this->model->where('book_id', $id)
            ->where('is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
            ->first();
    }

    public function getListComic($page, $limit, $userId, $bookLeagues, $blockBooks)
    {
        $comicList = $this->model->select('books.*', 'u.nickname', DB::raw('e.id as is_evaluated'))
            ->leftJoin('users as u', 'books.user_id', 'u.user_id')
            ->leftJoin('evaluations as e', function($leftJoin) use ($userId) {
                $leftJoin->on('e.user_id', '=', DB::raw($userId));
                $leftJoin->on('e.book_id', '=', 'books.book_id');
                $leftJoin->whereNull('e.league_id');
            })
            ->whereNotIn('books.book_id', $bookLeagues)
            ->whereNotIn('books.book_id', $blockBooks)
            ->where('books.is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
            ->orderBy('books.updated_at', 'DESC')
            ->orderBy('books.book_id', 'DESC')
            ->paginate($limit);

        foreach ($comicList as $comics) {
            if ($comics['is_evaluated'] == null) {
                $comics['is_evaluated'] = DBConstant::IS_NOT_EVALUATED;
            } else {
                $comics['is_evaluated'] = DBConstant::IS_EVALUATED;
            }
        }

        return $comicList;
    }

    public function getSearchData($keyword)
    {
        return $this->model->where('title', 'like', '%' . $keyword . '%')
                           ->where('is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
                           ->get();
    }

    public function getBookOfUser($userId)
    {
        $books = DB::table("books")
            ->leftJoin('book_league_mappings AS blm', 'blm.book_id', '=', 'books.book_id')
            ->leftJoin('leagues', 'leagues.league_id', '=', 'blm.league_id')
            ->select('books.*', 'leagues.name As league_name', 'leagues.league_id As league_id', 'leagues.type As league_type')
            ->orderBy('books.book_id', 'desc')
            ->where('books.user_id', $userId)
            ->where('is_hidden', 0)
            ->paginate(10);

        foreach ($books as $key => $value) {
            if ($value->league_id != null && $value->league_type == DBConstant::TYPE_FINAL_ROUND) {
                unset($books[$key]);
            } 
        }

        return $books;
    }

    public function getUnHiddenBookOfUser($userId)
    {
        return $this->model->where('user_id', $userId)
                           ->where('is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
                           ->pluck('book_id')->toArray();
    }

    public function getLeagueOfBookUploaded($userId)
    {
        return DB::table("books")
            ->leftJoin('book_league_mappings AS blm', 'blm.book_id', '=', 'books.book_id')
            ->leftJoin('leagues', 'leagues.league_id', '=', 'blm.league_id')
            ->select('books.*', 'leagues.name As league_name', 'leagues.league_id As league_id')
            ->orderBy('books.book_id', 'desc')
            ->where('books.user_id', $userId)
            ->whereNotNull('leagues.league_id')
            ->where('is_hidden', 0)
            ->pluck('league_id')
            ->toArray();
    }

    public function getByUserId($userId)
    {
        return $this->model->where('user_id', $userId)
                           ->where('is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
                           ->pluck('book_id')
                           ->toArray();
    }

    public function getByMultiUser($userIds)
    {
        return $this->model->whereIn('user_id', $userIds)
                           ->where('is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
                           ->pluck('book_id')
                           ->toArray();
    }
}
