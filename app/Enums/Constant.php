<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Constant enum.
 */
class Constant extends BaseEnum
{
    const ORDER_BY_DESC = 'desc';

    const ORDER_BY_ASC = 'asc';

    const IMAGE_OBJECT_USER = 'users';

    const IMAGE_OBJECT_EVENT = 'events';

    const IMAGE_OBJECT_IMAGE = 'profiles';

    const IMAGE_OBJECT_VIDEO = 'videos';

    const IMAGE_OBJECT_BOOK = 'books';

    const DEFAULT_LIMIT = 10;

    const ITEM_PER_PAGE = [
        '10' => '10',
        '20' => '20',
        '100' => '100',
    ];

    const PEOPLE = '人';

    const POINT = 'ポイント';

    const RANK_DEFAULT = 1;

    const ENTRY_FREE_DEFAULT = 0;

    const DATA_STRING_DEFAULT = 'null';

    const DATA_INT_DEFAULT = 0;

    const LEAGUE_TYPE = [
        1 => '予選',
        2 => '決勝',
    ];

    const STATUS = [
        0 => '申請中',
        1 => '振込済み'
    ];

    const SEX_RANGE = [0, 1, 2, 9];

    const DEFAULT_PAGE = 1;

    const EVENT_LIMIT = 10;

    const VIDEO_LIMIT = 10;

    const SEX = [
        0 => '',
        1 => '男性',
        2 => '女性',
        9 => '',
    ];

    const UNIT_POINT = 'pt';

    const UPDATE_PASSWORD = 1;

    const UPDATE_INFO = 2;

    const HOME_LIMIT_RELATED_LINKS = 4;
    const HOME_LIMIT_EVENTS = 5;
    const HOME_LIMIT_BOOKS = 5;
    const HOME_LIMIT_VIDEOS = 24;
    const HOME_LIMIT_RANNKING = 5;
    const HOME_LIMIT_SEARCH = 15;

    const EVALUATION_HISTORY_LIMIT = 20;

    // Google App Purchase
    const GOOGLE_APP_PURCHASE_SUCCESS = 0;
    const GOOGLE_APP_PURCHASE_CANCELED = 1;
    const GOOGLE_APP_PURCHASE_PENDING = 2;

    const TRANSFER_FEE = 200;
}
