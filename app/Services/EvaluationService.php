<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\League\LeagueRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\BookLeagueMapping\BookLeagueMappingRepositoryInterface;
use Exception;

class EvaluationService extends BaseService
{
    protected $leagueRepository;
    protected $bookRepository;
    protected $evaluationRepository;
    protected $bookLeagueMappingRepository;

    public function __construct(
        LeagueRepositoryInterface $leagueRepository,
        BookRepositoryInterface $bookRepository,
        EvaluationRepositoryInterface $evaluationRepository,
        BookLeagueMappingRepositoryInterface $bookLeagueMappingRepository
    ) {
        $this->leagueRepository = $leagueRepository;
        $this->bookRepository = $bookRepository;
        $this->evaluationRepository = $evaluationRepository;
        $this->bookLeagueMappingRepository = $bookLeagueMappingRepository;
    }

    public function createEvaluate($params)
    {
        try {
            if ($params['league_id']) {
                $league = $this->leagueRepository->getEntryLeauge($params['league_id']);

                if (!$league) {
                    return [
                        'success' => false,
                        'msg' => trans('message.out_date_evalution')
                    ];
                }
            }

            $book = $this->bookRepository->getUnHiddenBook($params['book_id']);

            if (!$book) {
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_4041')
                ];
            }

            if ($book->user_id == $params['user_id']) {
                return [
                    'success' => false,
                    'msg' => trans('message.not_evaluate_yourself')
                ];
            }

            $evaluation = $this->evaluationRepository->getEvaluation([
                'user_id' => $params['user_id'],
                'book_id' => $params['book_id'],
                'league_id' => $params['league_id'],
            ]);

            if ($evaluation) {
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_4041')
                ];
            }

            $data = $this->evaluationRepository->create([
                'user_id' => $params['user_id'],
                'book_id' => $params['book_id'],
                'league_id' => $params['league_id'],
                'score' => $params['score']
            ]);

            if ($params['league_id']) {
                $this->bookLeagueMappingRepository->updateTotalScore($params['book_id'], $params['league_id'], $params['score']);
            }

            return [
                'success' => true,
                'data' => $data
            ];
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getUserEvaluation($params)
    {
        $page = $params['page'] ?? null;
        $limit = $params['perpage'] ?? null;
        $evaluations = $this->evaluationRepository->getUserEvaluation($params['user_id'], $page, $limit);

        $data = [
            'page' => $page,
            'evaluation_histories' => $evaluations
        ];

        return $data;
    }

    public function getOwnBookEvaluation($params)
    {
        $page = $params['page'] ?? Constant::DEFAULT_PAGE;
        $limit = $params['perpage'] ?? Constant::EVALUATION_HISTORY_LIMIT;
        $bookIds = $this->bookRepository->getUnHiddenBookOfUser($params['user_id']);
        $evaluations = $this->evaluationRepository->getOwnBookEvaluation($bookIds, $page, $limit);

        $data = [
            'page' => $page,
            'own_books_evaluation' => $evaluations
        ];

        return $data;
    }
}
