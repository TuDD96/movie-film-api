<?php

namespace App\Repositories\Evaluation;

use App\Repositories\EloquentRepositoryInterface;

interface EvaluationRepositoryInterface extends EloquentRepositoryInterface
{
    public function getEvaluation($params);

    public function getTopRanking($leagueId);

    public function getUserEvaluation($userId, $page, $limit);

    public function getOwnBookEvaluation($bookIds, $page, $limit);
}
