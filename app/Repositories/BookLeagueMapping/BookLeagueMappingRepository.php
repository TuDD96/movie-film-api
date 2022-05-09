<?php

namespace App\Repositories\BookLeagueMapping;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Models\BookLeagueMapping;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class BookLeagueMappingRepository extends EloquentRepository implements BookLeagueMappingRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return BookLeagueMapping::class;
    }

    public function getWinnerOfPreliminaryRound($leagueIds)
    {
        $winnerBooks = [];
        foreach ($leagueIds as $leagueId) {
            $maxScore = $this->model::where('league_id', $leagueId)->max('total_score');
            $items = $this->model::where('league_id', $leagueId)->where('total_score', $maxScore)->pluck('book_id')->toArray();
            foreach ($items as $item) {
                $winnerBooks[] = $item;
            }
        }

        return $winnerBooks;
    }

    public function entryBook($page, $limit, $leagueId, $userId)
    {
        return $this->model->select(
            'book_league_mappings.*',
            'b.*',
            'u.nickname',
            'e.id as evaluation_id')
            ->join('books as b', 'b.book_id', 'book_league_mappings.book_id')
            ->join('users as u', 'u.user_id', 'b.user_id')
            ->leftJoin('evaluations as e', function($leftJoin) use ($leagueId, $userId) {
                $leftJoin->on('e.user_id', '=', DB::raw($userId));
                $leftJoin->on('e.book_id', '=', 'book_league_mappings.book_id');
                $leftJoin->on('e.league_id', '=', DB::raw($leagueId));
            })
            ->where('book_league_mappings.league_id', $leagueId)
            ->where('b.is_hidden', DBConstant::BOOKS_NOT_HIDDEN)
            ->orderBy('book_league_mappings.total_score', 'DESC')
            ->paginate($limit);
    }

    public function deleteBookLeagueMapping($bookId)
    {
        return $this->model->where("book_id", $bookId)->delete();
    }

    public function getLeagueMappingBookWithLeague($leagueId)
    {
        return $this->model->where('league_id', $leagueId)->get();
    }

    public function updateScoreWithLeagueAndBook($bookId, $leagueId, $score)
    {
        return $this->model->where('book_id', $bookId)->where('league_id', $leagueId)->update(['total_score' => $score]);
    }

    public function updateTotalScore($bookId, $leagueId, $score)
    {
        $this->model->where('book_id', $bookId)
                    ->where('league_id', $leagueId)
                    ->increment('total_score', $score);
        
        return true;
    }

    public function getAllBookId()
    {
        return $this->model->pluck('book_id')->toArray();
    }
}
