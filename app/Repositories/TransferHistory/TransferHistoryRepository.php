<?php

namespace App\Repositories\TransferHistory;

use App\Models\TransferHistory;
use App\Repositories\EloquentRepository;

class TransferHistoryRepository extends EloquentRepository implements TransferHistoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return TransferHistory::class;
    }

    public function getList($filters, $limit, $sorts)
    {
        $query = $this->model->select(
            'transfer_histories.*',
            'u.user_id',
            'u.nickname',
            'u.bank_name',
            'u.branch_name',
            'u.account_type',
            'u.account_number',
            'u.account_last_name',
            'u.account_first_name')
            ->join('users as u', 'u.user_id', 'transfer_histories.user_id');

        foreach ($filters as $key => $where) {
            if ($where['value'] === '') {
                continue;
            }
            if ($where['where'] == 'like') {
                $query = $query->where($key, 'like', '%' . $where['value'] . '%');
            } elseif ($where['where'] == '=') {
                $query = $query->where($key, '=', $where['value']);
            } else {
                if (!$where['valueFrom']) {
                    $query = $query->where($key, '<=', $where['valueTo']);
                }
                $query = $query->whereBetween($key, [$where['valueFrom'], $where['valueTo']]);
            }
        }

        if (isset($sorts)) {
            if (isset($sorts['transfer_history_id'])) {
                $query->orderBy('transfer_histories.id', $sorts['transfer_history_id']);
            }
            if (isset($sorts['created_at'])) {
                $query->orderBy('transfer_histories.created_at', $sorts['created_at']);
            }
            if (isset($sorts['user_id'])) {
                $query->orderBy('up.user_id', $sorts['user_id']);
            }
            if (isset($sorts['nickname'])) {
                $query->orderBy('u.nickname', $sorts['nickname']);
            }
            if (isset($sorts['status'])) {
                $query->orderBy('transfer_histories.status', $sorts['status']);
            }
            if (isset($sorts['withdrawal_amount'])) {
                $query->orderBy('transfer_histories.withdrawal_amount', $sorts['withdrawal_amount']);
            }
            if (isset($sorts['transfer_fee'])) {
                $query->orderBy('transfer_histories.transfer_fee', $sorts['transfer_fee']);
            }
            if (isset($sorts['transfer_amount'])) {
                $query->orderBy('transfer_histories.transfer_amount', $sorts['transfer_amount']);
            }
            if (isset($sorts['bank_name'])) {
                $query->orderBy('u.bank_name', $sorts['bank_name']);
            }
            if (isset($sorts['account_type'])) {
                $query->orderBy('u.account_type', $sorts['account_type']);
            }
            if (isset($sorts['account_number'])) {
                $query->orderBy('u.account_number', $sorts['account_number']);
            }
            if (isset($sorts['account_name'])) {
                $query->orderBy('u.account_last_name', $sorts['account_name']);
            }
            if (isset($sorts['transferred_at'])) {
                $query->orderBy('transfer_histories.transferred_at', $sorts['transferred_at']);
            }
        }

        return $query->orderBy('transfer_histories.created_at', 'ASC')->paginate($limit);
    }
}
