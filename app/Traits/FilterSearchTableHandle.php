<?php

namespace App\Traits;

use Illuminate\Support\Collection as BaseCollection;

trait FilterSearchTableHandle {

    public function extractFilter($sortList)
    {
        return collect(explode(',', $sortList))
            ->mapWithKeys(function ($item) {
                $item = explode('-', $item);
                if ($item[0] == 'userid') {
                    $item[0] = 'user_id';
                }
                $key = $item[0];
                $value = $item[1];
                return [$key => $value];
            })
            ->toArray();
    }
}