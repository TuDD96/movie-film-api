<?php

namespace App\Repositories\League;

use App\Repositories\EloquentRepositoryInterface;

interface LeagueRepositoryInterface extends EloquentRepositoryInterface
{
    public function deleteLeagueByEventId($eventId);

    public function checkFinalRoundExists($eventId);

    public function checkPreliminaryRound($eventId);

    public function getPreliminaryRoundByEventId($eventId);

    public function updatePreliminaryRound($eventId, $finalLeagueId);

    public function search();

    public function getPreliminaryLeauge($id);

    public function getEntryLeauge($id);

    public function getByEvent($eventId, $userId, $books);

    public function getListLeague();

    public function getLeagueRanking();
}
