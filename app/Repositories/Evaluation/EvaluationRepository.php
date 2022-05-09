<?php

namespace App\Repositories\Evaluation;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Models\Evaluation;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class EvaluationRepository extends EloquentRepository implements EvaluationRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Evaluation::class;
    }

    public function getEvaluation($params)
    {
        return $this->model->where('user_id', $params['user_id'])
                           ->where('book_id', $params['book_id'])
                           ->where('league_id', $params['league_id'])
                           ->first();
    }

    public function getTopRanking($leagueId)
    {
        return $this->model->select(
            'evaluations.book_id',
            'evaluations.league_id',
            'b.title',
            DB::raw('sum(evaluations.score) as total_score'))
            ->join('books as b', 'b.book_id', 'evaluations.book_id')
            ->where('evaluations.league_id', $leagueId)
            ->where('b.is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
            ->groupBy('book_id')
            ->orderBy('total_score', 'DESC')
            ->get();
    }

    public function getUserEvaluation($userId, $page, $limit)
    {
        $query = $this->model->select(
            'evaluations.book_id',
            'evaluations.league_id',
            'evaluations.score',
            'evaluations.created_at',
            'b.thumbnail_url',
            'b.ebook_url',
            'b.title',
            'b.is_hidden',
            'b.user_id',
            'ip.image_url as user_avatar')
            ->join('books as b', 'b.book_id', 'evaluations.book_id')
            ->leftJoin('image_paths as ip', 'ip.user_id', 'b.user_id')
            ->where('evaluations.user_id', $userId)
            ->where('b.is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
            ->orderBy('evaluations.created_at', 'DESC');

        if ($page && $limit) {
            $query = $query->limit($limit)->offset(($page - 1) * $limit);
        }
            
        return $query->get();
    }

    public function getOwnBookEvaluation($bookIds, $page, $limit)
    {
        return $this->model->select(
            'evaluations.book_id',
            'evaluations.league_id',
            'evaluations.score',
            'b.thumbnail_url',
            'b.ebook_url',
            'b.title',
            'b.is_hidden')
            ->join('books as b', 'b.book_id', 'evaluations.book_id')
            ->whereIn('evaluations.book_id', $bookIds)
            ->where('b.is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
            ->orderBy('evaluations.created_at', 'DESC')
            ->limit($limit)->offset(($page - 1) * $limit)
            ->get();
    }

    public function deleteEvaluationOfBook($bookId)
    {
        return $this->model->where('book_id', $bookId)->delete();
    }
}
