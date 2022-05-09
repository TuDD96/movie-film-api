<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Repositories\TransferHistory\TransferHistoryRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class TransferHistoryService
{
    protected $transferHistoryRepository;
    protected $userRepository;

    public function __construct(
        TransferHistoryRepositoryInterface $transferHistoryRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->transferHistoryRepository = $transferHistoryRepository;
        $this->userRepository = $userRepository;
    }

    public function searchPagination($params)
    {
        if (isset($params['created_at_from']) && !isset($params['created_at_to'])) {
            $createdDateFrom = date("Y-m-d H:i:s", strtotime($params['created_at_from']));
            $createdDateTo = now()->format("Y-m-d H:i:s");
        }

        if (isset($params['created_at_to']) && !isset($params['created_at_from'])) {
            $createdDateFrom = false;
            $createdDateTo = date("Y-m-d H:i:s", strtotime($params['created_at_to']));
        }

        if (isset($params['created_at_to']) && isset($params['created_at_from'])) {
            $createdDateFrom = date("Y-m-d H:i:s", strtotime($params['created_at_from']));
            $createdDateTo = date("Y-m-d H:i:s", strtotime($params['created_at_to']));
        }

        if (!isset($params['created_at_to']) && !isset($params['created_at_from'])) {
            $createdDateFrom = null;
            $createdDateTo = null;
        }

        $filters = [
            'transfer_histories.created_at' => [
                'where' => 'date',
                'value' => null,
                'valueFrom' => null,
                'valueTo' => null,
            ],
            'u.user_id' => [
                'where' => '=',
                'value' => null,
            ],
            'u.nickname' => [
                'where' => 'like',
                'value' => null,
            ],
            'transfer_histories.status' => [
                'where' => '=',
                'value' => null,
            ]
        ];
        if (!isset($params['created_at_from']) && !isset($params['created_at_to'])) {
            $filters['transfer_histories.created_at']['value'] = '';
        }
        $filters['transfer_histories.created_at']['valueFrom'] = $createdDateFrom ?? '';
        $filters['transfer_histories.created_at']['valueTo'] = $createdDateTo ?? '';
        $filters['u.user_id']['value'] = $params['user_id'] ?? '';
        $filters['u.nickname']['value'] = $params['nickname'] ?? '';
        $filters['transfer_histories.status']['value'] = $params['status'] ?? '';

        $limit = $params['limit'] ?? Constant::DEFAULT_LIMIT;
        $sorts = $params['sort'] ?? '';
        $data = $this->transferHistoryRepository->getList($filters, $limit, $sorts);

        return $data;
    }

    public function approveWithdrawal($id)
    {
        try {
            $this->transferHistoryRepository->update($id, [
                'status' => DBConstant::STATUS_APPLIED_APPROVED,
                'transferred_at' => now()
            ]);

            return true;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getWithdrawal($params)
    {
        DB::beginTransaction();

        try {
            $transfer = $this->transferHistoryRepository->create([
                'user_id' => $params['user_id'],
                'status' => DBConstant::STATUS_APPLIED,
                'withdrawal_amount' => $params['amount'] + Constant::TRANSFER_FEE,
                'transfer_fee' => Constant::TRANSFER_FEE,
                'transfer_amount' => $params['amount']
            ]);

            $user = $this->userRepository->update($params['user_id'], ['points_received' => $params['points_received'] - $params['amount'] - Constant::TRANSFER_FEE]);

            DB::commit();

            return [
                'transfer_history_id' => $transfer->id,
                'status' => $transfer->status,
                'transfer_amount' => $transfer->transfer_amount,
                'points_received' => $user->points_received
            ];
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
