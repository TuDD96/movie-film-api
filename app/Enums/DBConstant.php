<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * DBConstant enum.
 */
class DBConstant extends BaseEnum
{
    // Archive flag
    const NOT_ARCHIVED_FLAG = 0;
    const ARCHIVED_FLAG = 1;

    // User type
    const USER_TYPE_GENERAL_USER = 1;
    const USER_TYPE_MGMT_PORTAL_USER = 2;

    // [books] hidden
    const BOOKS_IS_HIDDEN = 1;
    const BOOKS_NOT_HIDDEN = 0;

    // [device_tokens] platform
    const IOS_PLATFORM = 1;
    const ANDROID_PLATFORM = 2;

    // [leagues] type
    const TYPE_PRELIMINARY_ROUND = 1;
    const TYPE_FINAL_ROUND = 2;

    // [prefectures] is_default
    const IS_DEFAULT = 1;
    const IS_NOT_DEFAULT = 0;

    // [refresh_tokens] is_blacklisted
    const IS_NOT_BLACKLISTED = 0;
    const IS_BLACKLISTED = 1;

    // [transfer_histories] status
    const STATUS_APPLIED = 0;
    const STATUS_APPLIED_APPROVED = 1;

    // [user_gifts] status
    const STATUS_UNUSED = 0;
    const STATUS_USED = 1;

    // [user_points] type
    const TYPE_DEPOSIT = 1;
    const TYPE_WITHDRAWAL = 2;

    // [user_points] deposit_reason
    const DEPOSIT_REASON_PURCHASE = 1;

    // [user_points] withdrawal_reason
    const WITHDRAWAL_REASON_EVENT_ENTRY = 1;
    const WITHDRAWAL_REASON_EXCHANGE_FOR_A_GIFT = 2;

    // [users] login_type
    const LOGIN_TYPE_EMAIL = 'EMAIL';
    const LOGIN_TYPE_INSTAGRAM = 'INSTAGRAM';
    const LOGIN_TYPE_FACEBOOK = 'FACEBOOK';
    const LOGIN_TYPE_TWITTER = 'TWITTER';

    // [users] sex
    const SEX_NOT_KNOWN = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;
    const SEX_NOT_APPLICABLE = 9;

    // [users] account_type
    const ACCOUNT_TYPE_SAVINGS_ACCOUNT = 1;
    const ACCOUNT_TYPE_POSTAL_SAVINGS = 2;

    // [users] is_authenticated
    const IS_AUTHENTICATED_NOT_AUTHENTICATED = 0;
    const IS_AUTHENTICATED_AUTHENTICATED = 1;
    const IS_AUTHENTICATED_NO_AUTHENTICATION_REQUIRED = 2;

    // [user] is_archived
    const IS_NOT_ARCHIVED = 0;
    const IS_ARCHIVED = 1;

    // [image_paths] display_order
    const IMAGE_PATH_DISPLAY_ORDER = 1;

    // [book] is evaluated
    const IS_EVALUATED = 1;
    const IS_NOT_EVALUATED = 0;

    const REPORT_REASON = [
        1 => '当日キャンセル',
        2 => '暴言/暴力',
        3 => '詐欺・ビジネス勧誘',
        4 => '売春・風俗業者',
        5 => 'ストーカー',
        6 => '17歳以下・高校生',
        7 => 'その他',
    ];
}
