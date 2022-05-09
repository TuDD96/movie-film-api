<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\League\LeagueRepositoryInterface;
use App\Repositories\BookLeagueMapping\BookLeagueMappingRepositoryInterface;
use App\Repositories\Applicant\ApplicantRepositoryInterface;
use App\Repositories\UserPoint\UserPointRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Evaluation\EvaluationRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Traits\CollectionPagination;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class LeagueService extends BaseService
{
    protected $leagueRepository;
    protected $bookLeagueMappingRepository;
    protected $applicantRepository;
    protected $userPointRepository;
    protected $userRepository;
    protected $evaluationRepository;
    protected $bookRepository;

    public function __construct(
        LeagueRepositoryInterface $leagueRepository,
        BookLeagueMappingRepositoryInterface $bookLeagueMappingRepository,
        ApplicantRepositoryInterface $applicantRepository,
        UserPointRepositoryInterface $userPointRepository,
        UserRepositoryInterface $userRepository,
        EvaluationRepositoryInterface $evaluationRepository,
        BookRepositoryInterface $bookRepository
    ) {
        $this->leagueRepository = $leagueRepository;
        $this->bookLeagueMappingRepository = $bookLeagueMappingRepository;
        $this->applicantRepository = $applicantRepository;
        $this->userPointRepository = $userPointRepository;
        $this->userRepository = $userRepository;
        $this->evaluationRepository = $evaluationRepository;
        $this->bookRepository = $bookRepository;
    }

    public function createPreliminary($request)
    {
        try {
            $data = $request->only([
                'name',
                'entry_fee',
                'fixed_num',
                'entry_start_datetime',
                'entry_start_datetime',
                'entry_end_datetime',
                'start_datetime',
                'end_datetime',
                'event_id',
            ]);
            $data['type'] = DBConstant::TYPE_PRELIMINARY_ROUND;
            $data['parent_league_id'] = null;
            $this->leagueRepository->create($data);

            return [
                'success' => true,
                'msg' => trans('message.add_success')
            ];
        } catch (Exception $exception) {
            return [
                'success' => false,
                'msg' => trans('errors.MSG_5003')
            ];
        }
    }

    public function createFinal($request)
    {
        DB::beginTransaction();
        try {
            $now = Carbon::now();
            $data = $request->only([
                'name',
                'start_datetime',
                'end_datetime',
                'event_id',
            ]);
            $checkFinalRoundExists = $this->leagueRepository->checkFinalRoundExists($data['event_id']);
            if($checkFinalRoundExists) {
                return [
                    'success' => false,
                    'msg' => trans('message.final_exists')
                ];
            }
            $checkPreliminaryRound = $this->leagueRepository->checkPreliminaryRound($data['event_id']);
            if($checkPreliminaryRound) {
                return [
                    'success' => false,
                    'msg' => trans('message.preliminary_round_not_end')
                ];
            }
            $preliminaryRounds = $this->leagueRepository->getPreliminaryRoundByEventId($data['event_id']);
            $leagueIds = [];
            foreach ($preliminaryRounds as $preliminaryRound) {
                $leagueIds[] = $preliminaryRound->league_id;
            }
            $winnerOfPreliminaryRounds = $this->bookLeagueMappingRepository->getWinnerOfPreliminaryRound($leagueIds);
            $data['type'] = DBConstant::TYPE_FINAL_ROUND;
            $data['entry_fee'] = Constant::ENTRY_FREE_DEFAULT;
            $data['created_at'] = $now;
            $data['updated_at'] = $now;
            $finalLeagueId = $this->leagueRepository->insertGetId($data);
            $this->leagueRepository->updatePreliminaryRound($data['event_id'], $finalLeagueId);
            $dataBookLeagueMapping = [];
            foreach ($winnerOfPreliminaryRounds as $winnerOfPreliminaryRound) {
                $dataBookLeagueMapping[] = [
                    'book_id' => $winnerOfPreliminaryRound,
                    'league_id' => $finalLeagueId,
                    'total_score' => Constant::DATA_INT_DEFAULT,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            if (!empty($dataBookLeagueMapping)) {
                $this->bookLeagueMappingRepository->insert($dataBookLeagueMapping);
            }

            DB::commit();
            return [
                'success' => true,
                'msg' => trans('message.add_success')
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            return [
                'success' => false,
                'msg' => trans('errors.MSG_5003')
            ];
        }
    }

    public function searchPagination($request)
    {
        $limit = $request['limit'] ?? Constant::DEFAULT_LIMIT;
        $sorts = $request['sort'] ?? '';

        $data = $this->leagueRepository->search();

        if (!empty($sorts)) {
            $sorts = explode(',', $sorts);
            if (is_array($sorts)) {
                foreach($sorts as $sort) {
                    if ($sort) {
                        $sort = explode('-', $sort);
                        $sortField = $sort[0];
                        $sortBy = strtolower($sort[1]);
                        if ($sortField === 'title') {
                            if ($sortBy === Constant::ORDER_BY_ASC) {
                                $data = $data->sortBy(function ($query) {
                                    try {
                                        return $query->event->title;
                                    } catch (Exception $e) {
                                        return 0;
                                    }
                                }, SORT_NATURAL|SORT_FLAG_CASE);
                            } else {
                                $data = $data->sortByDesc(function ($query) {
                                    try {
                                        return $query->event->title;
                                    } catch (Exception $e) {
                                        return 0;
                                    }
                                }, SORT_NATURAL|SORT_FLAG_CASE);
                            }
                        } else {
                            if ($sortBy === Constant::ORDER_BY_ASC) {
                                $data = $data->sortBy(function($query) use ($sortField) {
                                    return [$query->$sortField, $query->league_id];
                                });
                            } else {
                                $sorting_instructions = [
                                    ['column'=>$sortField, 'order'=>'desc'],
                                    ['column'=>'league_id', 'order'=>'asc'],
                                ];
                                $data = $this->leagueRepository->multiPropertySort($data, $sorting_instructions);
                            }
                        }
                    }
                }
            }
        }

        return (new CollectionPagination($data))->paginate($limit);
    }

    public function delete($request)
    {
        try {
            $leagueId = $request->league_id;
            if (!$leagueId) {
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_5006')
                ];
            }
            $this->leagueRepository->delete($leagueId);

            return [
                'success' => true,
                'msg' => trans('message.delete_success')
            ];
        } catch (Exception $exception) {
            return [
                'success' => false,
                'msg' => trans('errors.MSG_5006')
            ];
        }
    }

    public function entryBook($params, $leagueId, $userId)
    {
        try {
            $page = $params['page'] ?? Constant::DEFAULT_PAGE;
            $limit = $params['perpage'] ?? Constant::DEFAULT_LIMIT;
            $league = $this->leagueRepository->find($leagueId);
            $entryBook = $this->bookLeagueMappingRepository->entryBook($page, $limit, $leagueId, $userId);
            $totalPage = $entryBook->lastPage();
            $entryBook = $entryBook->map(function($item) {
                $book = [
                    'book_id' => $item->book_id,
                    'user_id' => $item->user_id,
                    'nickname' => $item->nickname,
                    'thumbnail_url' => $item->thumbnail_url,
                    'ebook_url' => $item->ebook_url,
                    'title' => $item->title,
                    'total_score' => $item->total_score,
                ];
                if (!$item->evaluation_id) {
                    $book['is_evaluated'] = 0;
                } else {
                    $book['is_evaluated'] = 1;
                }

                return $book;
            });

            $league->books = [
                'page' => $page,
                'total_page' => $totalPage,
                'data' => $entryBook
            ];

            return $league;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function entryLeague($leagueId, $user)
    {
        DB::beginTransaction();

        try {
            $league = $this->leagueRepository->getPreliminaryLeauge($leagueId);

            if (!$league) {
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_4041')
                ];
            }

            if (($user->points_balance - $league->entry_fee) < 0) {
                return [
                    'success' => false,
                    'msg' => trans('message.not_enough_point')
                ];
            }

            if ($league->fixed_num == $league->num_of_applicants) {
                return [
                    'success' => false,
                    'msg' => trans('errors.MSG_4041')
                ];
            }

            $applicant = $this->applicantRepository->create([
                'user_id' => $user->user_id,
                'league_id' => $leagueId
            ]);

            $this->leagueRepository->update($leagueId, ['num_of_applicants' => $league->num_of_applicants + 1]);
            $userPoint = $this->userPointRepository->getByUserId($user->user_id);

            if (!$userPoint) {
                $pointBalance = $user->points_balance;
            } else {
                $pointBalance = $userPoint->points_balance;
            }

            if (($pointBalance - $league->entry_fee) < 0) {
                return [
                    'success' => false,
                    'msg' => trans('message.not_enough_point')
                ];
            }

            $this->userPointRepository->create([
                'user_id' => $user->user_id,
                'type' => DBConstant::TYPE_WITHDRAWAL,
                'deposit_points' => null,
                'deposit_reason' => null,
                'withdrawal_points' => $league->entry_fee,
                'withdrawal_reason' => DBConstant::WITHDRAWAL_REASON_EVENT_ENTRY,
                'points_balance' => $pointBalance - $league->entry_fee,
                'transacted_at' =>now(),
            ]);
            $this->userRepository->update($user->user_id, ['points_balance' => $pointBalance - $league->entry_fee]);

            DB::commit();

            return [
                'success' => true,
                'data' => $applicant
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function getTopRanking($leagueId)
    {
        try {
            $topRanking = $this->evaluationRepository->getTopRanking($leagueId);
            $scoreArr = array_unique($topRanking->pluck('total_score')->toArray());

            if (count($scoreArr) > 0 ) $maxScore = max($scoreArr);
           
            $highestScoreBooks = [];

            if (count(array_slice($scoreArr, 1)) > 0 ) $secondScore = max(array_slice($scoreArr, 1));
            
            $secondScoreBooks = [];

            if (count(array_slice($scoreArr, 2)) > 0 ) $thirdScore = max(array_slice($scoreArr, 2));
            
            $thirdScoreBooks = [];
            $otherBooks = [];

            foreach($topRanking as $key => $value) {
                if ($value['total_score'] == $maxScore) {
                    $topRanking[$key]['rank'] = 1;
                    array_push($highestScoreBooks, $topRanking[$key]);
                } elseif ($value['total_score'] == $secondScore) {
                    $topRanking[$key]['rank'] = 2;
                    array_push($secondScoreBooks, $topRanking[$key]);
                } elseif ($value['total_score'] == $thirdScore) {
                    $topRanking[$key]['rank'] = 3;
                    array_push($thirdScoreBooks, $topRanking[$key]);
                } else {
                    $topRanking[$key]['rank'] = 4;
                    array_push($otherBooks, $topRanking[$key]);
                }
            }
            
            $otherBooks = array_slice($otherBooks, 0, 2);

            $arrTopRanking = array_merge($highestScoreBooks, $secondScoreBooks, $thirdScoreBooks, $otherBooks);

            return $arrTopRanking;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getListLeague()
    {
        return $this->leagueRepository->getListLeague();
    }

    public function getLeagueActiveService()
    {
        $userId = auth('client')->user()->user_id;
        $leagues = $this->leagueRepository->getEventActive($userId);
        $aplicants = $this->applicantRepository->getApplicantOfUser($userId)->toArray();
        $leagueOfbooks = $this->bookRepository->getLeagueOfBookUploaded($userId);

        foreach ($leagues as $key => $league) {
            if (!in_array($league->league_id, $aplicants, TRUE)) {
                unset($leagues[$key]);
            } else {
                if (in_array($league->league_id, $leagueOfbooks, TRUE)) {
                    unset($leagues[$key]);
                }
            }
        }
    
        return $leagues;
    }

    public function getLeagueEvaluationService()
    {
        return $this->leagueRepository->getLeagueEvaluation();
    }

    function secondMax($arr) {
        $second = null;

        foreach($arr as $key => $value) {
            if($arr[$key] > $arr[$key + 1]) {
                $second == $value;
            }
        }
    
        return $second;
    }
}
