<?php

namespace App\Repositories\League;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Models\League;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeagueRepository extends EloquentRepository implements LeagueRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return League::class;
    }

    public function deleteLeagueByEventId($eventId)
    {
        return $this->model::where('event_id', $eventId)->delete();
    }

    public function checkFinalRoundExists($eventId)
    {
        return $this->model::where('event_id', $eventId)->where('type', DBConstant::TYPE_FINAL_ROUND)->count() > 0;
    }

    public function checkPreliminaryRound($eventId)
    {
        $now = Carbon::now();

        return $this->model::where('event_id', $eventId)
            ->where('type', DBConstant::TYPE_PRELIMINARY_ROUND)
            ->where('end_datetime', '>=', $now)
            ->count() > 0;
    }

    public function getPreliminaryRoundByEventId($eventId)
    {
        return $this->model::where('event_id', $eventId)
            ->where('type', DBConstant::TYPE_PRELIMINARY_ROUND)
            ->get();
    }

    public function updatePreliminaryRound($eventId, $finalLeagueId)
    {
        return $this->model::where('event_id', $eventId)
            ->where('type', DBConstant::TYPE_PRELIMINARY_ROUND)
            ->update(['parent_league_id' => $finalLeagueId]);
    }

    public function search()
    {
        return $this->model::with(['event:event_id,title'])
            ->orderBy('created_at', Constant::ORDER_BY_DESC)->get();
    }

    public function getPreliminaryLeauge($id)
    {
        return $this->model->where('league_id', $id)
                           ->where('type', DBConstant::TYPE_PRELIMINARY_ROUND)
                           ->where('entry_start_datetime', '<=', now())
                           ->where('entry_end_datetime', '>=', now())
                           ->first();
    }

    public function getEntryLeauge($id)
    {
        return $this->model->where('league_id', $id)
                           ->where('start_datetime', '<=', now())
                           ->where('end_datetime', '>=', now())
                           ->first();
    }

    public function getByEvent($eventId, $userId, $books)
    {
        return $this->model->select(
            'leagues.*',
            'a.applicant_id',
            'b.ebook_url')
            ->leftJoin('applicants as a', function($leftJoin) use ($userId) {
                $leftJoin->on('a.user_id', '=', DB::raw($userId));
                $leftJoin->on('a.league_id', '=', 'leagues.league_id');
            })
            ->leftJoin('book_league_mappings as blm', function ($leftJoin) use ($books) {
                $bookArr = join(',', $books);
                $leftJoin->on('blm.league_id', DB::raw("(select league_id from book_league_mappings blm2 where leagues.league_id = blm2.league_id order by created_at asc limit 1)"));
                if ($bookArr != "") {
                    $leftJoin->on('blm.book_id', DB::raw("(select book_id from book_league_mappings blm3 where leagues.league_id = blm3.league_id and blm3.book_id in ($bookArr) order by created_at asc limit 1)"));
                } else {
                    $leftJoin->on('blm.book_id', DB::raw("(select book_id from book_league_mappings blm3 where leagues.league_id = blm3.league_id and blm3.book_id = null order by created_at asc limit 1)"));
                }
            })
            ->leftJoin('books as b', 'b.book_id', 'blm.book_id')
            ->where('leagues.event_id', $eventId)
            ->orderBy('leagues.league_id', 'ASC')
            ->get();
    }

    public function getListLeague()
    {
        return $this->model->get();
    }

    public function multiPropertySort($collection, $sorting_instructions = []){

        return $collection->sort(function ($a, $b) use ($sorting_instructions){

            foreach($sorting_instructions as $sorting_instruction){

                $a[$sorting_instruction['column']] = (isset($a[$sorting_instruction['column']])) ? $a[$sorting_instruction['column']] : '';
                $b[$sorting_instruction['column']] = (isset($b[$sorting_instruction['column']])) ? $b[$sorting_instruction['column']] : '';

                if (empty($sorting_instruction['order']) or strtolower($sorting_instruction['order']) == 'asc'){
                    $x = ($a[$sorting_instruction['column']] <=> $b[$sorting_instruction['column']]);
                } else {
                    $x = ($b[$sorting_instruction['column']] <=> $a[$sorting_instruction['column']]);

                }

                if ($x != 0){
                    return $x;
                }

            }

            return 0;

        })->values();
    }

    public function getEventActive($userId)
    {
        return $this->model
            ->where('leagues.entry_start_datetime', '<=', Carbon::now())
            ->where('leagues.entry_end_datetime', '>=', Carbon::now())
            ->where('leagues.is_archived', 0)
            ->get();
    }

    public function getLeagueEvaluation()
    {
        $now = Carbon::now();
        $end_datetime = Carbon::create($now->year, $now->month, $now->day, $now->hour, $now->minute, 0);

        return $this->model
            ->where('start_datetime', '<=', Carbon::now())
            ->where('end_datetime', '>=', $end_datetime)
            ->where('is_archived', 0)
            ->get();
    }

    public function getLeagueRanking()
    {
        return $this->model->select(
            'leagues.league_id',
            'leagues.name',
            'leagues.start_datetime',
            'leagues.end_datetime',
            'ip.image_url')
            ->join('events as e', 'e.event_id', 'leagues.event_id')
            ->leftJoin('image_paths as ip', 'ip.event_id', 'e.event_id')
            ->where(function ($query) {
                $query->where('leagues.start_datetime', '<=', now())
                      ->where('leagues.end_datetime', '>=', now());
            })
            ->orWhere('leagues.end_datetime', '<=', now())
            ->orderBy('leagues.updated_at', 'DESC')
            ->limit(Constant::HOME_LIMIT_RANNKING)
            ->get();
    }

    public function getEventActiveWithLeagueID($userId, $leagueId)
    {
        return $this->model
            ->join('applicants', 'applicants.league_id', '=', 'leagues.league_id')
            ->leftJoin('book_league_mappings AS blm', 'blm.league_id', '=', 'leagues.league_id')
            ->leftJoin('books', function($join) {
                $join->on('blm.book_id', '=', 'books.book_id');
                $join->on('books.user_id', '=', 'applicants.user_id');
            })
            ->where('leagues.entry_start_datetime', '<=', Carbon::now())
            ->where('leagues.entry_end_datetime', '>=', Carbon::now())
            ->where('leagues.is_archived', 0)
            ->where('applicants.user_id', $userId)
            ->where('leagues.league_id', $leagueId)
            ->select('leagues.*', 'blm.total_score', 'applicants.applicant_id', 'applicants.user_id', 'books.book_id')
            ->first();
    }
}
