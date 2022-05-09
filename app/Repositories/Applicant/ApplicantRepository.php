<?php

namespace App\Repositories\Applicant;

use App\Models\Applicant;
use App\Repositories\EloquentRepository;

class ApplicantRepository extends EloquentRepository implements ApplicantRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Applicant::class;
    }

    public function getLeagueMappingBookWithLeagueAndUser($leagueId, $userId)
    {
        return $this->model
            ->where('league_id', $leagueId)
            ->where('user_id', $userId)
            ->first();
    }

    public function getLeagueMappingBookWithLeague($leagueId)
    {
        return $this->model
            ->where('league_id', $leagueId)
            ->get();
    }

    public function getApplicantOfUser($userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->pluck('league_id');
    }
}
