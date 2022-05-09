<?php

namespace App\Repositories\BookLeagueMapping;

use App\Repositories\EloquentRepositoryInterface;

interface BookLeagueMappingRepositoryInterface extends EloquentRepositoryInterface
{
    public function getWinnerOfPreliminaryRound($leagueIds);

    public function entryBook($page, $limit, $leagueId, $userId);

    public function updateTotalScore($bookId, $leagueId, $score);

    public function getAllBookId();
}
