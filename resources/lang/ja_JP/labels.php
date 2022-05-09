<?php

return [
    'sidebar' => [
        'users' => 'ユーザー',
        'books' => 'マンガ',
        'events' => 'イベント',
        'leagues' => '対戦ブロック',
        'videos' => '動画',
        'withdrawals' => '出金申請',
        'mails' => 'メール送信'
    ],

    'login' => [
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'title' => 'ログイン',
        'click_here_to_reset_password' => 'パスワードをお忘れの方はこちら'
    ],

    'reset_password' => [
        'title' => 'パスワードの再発行',
        'description_1' => '登録済みのメールアドレスをご入力下さい。',
        'description_2' => 'ご入力いただいたメールアドレス宛にパスワード再発行の',
        'description_3' => 'お手続きに関するメールをお送りいたします。',
        'email_address' => 'メールアドレス',
        'return_login' => 'ログイン画面に戻る'
    ],

    'change_password' => [
        'title' => 'パスワードの再設定',
        'description' => 'ユーザーの確認ができましたので新しいパスワードをご入力下さい。',
        'password' => 'パスワード',
        'password_new' => '新しいパスワード',
        'password_confirm' => 'パスワード（確認用）',
        'password_new_confirm' => '新しいパスワード（確認）',
        'password_current' => '現在のパスワード',
        'button_change_password' => '変更する',
    ],

    'header' => [
        'logout' => 'ログアウト',
        'change_password' => 'パスワード変更',
        'change_passwor_information' => 'パスワード情報'
    ],

    'search_input' => [
        'user_id' => 'ユーザーID',
        'email' => 'Eメール',
        'nickname' => 'ユーザー名',
        'realname' => 'タレント氏名',
        'tipped_at' => '対象月',
        'client_id' => '事業主ID'
    ],

    'pagination' => [
        'display_record_label' => '件表示',
        'next' => '次',
        'pre' => '前',
    ],

    'upload_image' => [
        'upload_button' => 'ファイルを選択',
        'upload_title' => 'ここにファイルをドロップ',
        'upload_content' => ' または',
    ],

    'button' => [
        'search' => '検索',
        'detail' => '詳細',
        'point_purchase_history' => 'ポイント購入履歴',
        'ticket_purchase_history' => 'チケット購入履歴',
        'send' => '送信',
        'register' => '登録',
        'register_action' => '登録する',
        'back' => '一覧に戻る',
        'save' => '編集',
        'delete' => '削除',
        'cancel' => 'キャンセル',
        'delete-modal' => '削除する',
        'update' => '更新する',
        'sign_up' => '新規登録',
        'new_performance' => '公演新規作成',
        'send-email-follower' => 'フォロワーにメール',
        'push-follower' => 'フォロワーにPUSH',
        'send-email' => '送信する',
        'confirmed_button' => '当選確定する',
        'register_notice' => '配信する',
        'inventory_registration' => '在庫登録',
        'transferred_registration' => '振込済登録',
        'update_transferred_modal' => '振込済にする',
        'update_status_modal' => '確認する',
        'billing_confirmed' => '請求確定',
        'export_pdf' => 'PDF出力',
    ],

    'common' => [
        'no_data' => '対応するレコードが見つかりませんでした。',
    ],

    'users_tab' => [
        'list' => [
            'user_id' => 'ユーザーID',
            'title' => 'ユーザー',
            'email' => 'Eメール',
            'name_kanji' => '氏名',
            'name_kana' => 'フリガナ',
            'nickname' => 'ハンドルネーム',
            'sex' => '性別',
            'date_of_birth' => '生年月日',
            'phone' => '電話番号',
            'zip_code' => '郵便番号',
            'address' => '住所',
            'points_balance' => '購入ポイント',
            'points_received' => '獲得ポイント',
            'created_at' => '登録日時',
        ]
    ],

    'book_tab' => [
        'list' => [
            'title' => 'マンガ',
            'user_id' => 'ユーザーID',
            'book_title' => 'タイトル',
            'league_id' => '対戦ブロックID',
            'book_id' => 'マンガID',
            'event_title' => 'エントリーイベント名',
            'identity_verification_status' => '本人確認',
            'operation' => '操作',
            'hidden' => '非表示にする',
            'un_hidden' => '非表示解除'
        ],
    ],

    'events_tab' => [
        'list' => [
            'title_screen' => 'イベント',
            'event_id' => 'イベントID',
            'title' => 'イベント名',
            'created_at' => '登録日時',
            'edit' => '編集',
            'qualifying_block_creation' => '予選ブロック作成',
            'final_block_creation' => '決勝ブロック作成',
            'delete' => '削除',
            'operation' => '操作',
        ],
        'modal_confirm_delete' => [
            'content_title' => '本当にこのイベントを削除して',
            'content_body' => 'よろしいですか？',
        ],
        'add' => [
            'title_screen' => 'イベント 新規登録',
        ],
        'edit' => [
            'title_screen' => 'イベント 編集',
            'title' => 'イベント名',
            'body' => 'イベント詳細',
        ],
        'add_preliminary' => [
            'title_screen' => '予選ブロック 新規登録',
            'title' => 'イベント名',
            'name' => '予選ブロック名',
            'entry_fee' => 'エントリー料',
            'fixed_num' => '定員数',
            'entry_start_datetime' => 'エントリー開始日時',
            'entry_end_datetime' => 'エントリー終了日時',
            'start_datetime' => '対戦開始日時',
            'end_datetime' => '対戦終了日時',
        ],
        'add_final' => [
            'title_screen' => '決勝ブロック 新規登録',
            'title' => 'イベント名',
            'name' => '決勝ブロック名',
            'start_datetime' => '対戦開始日時',
            'end_datetime' => '対戦終了日時',
            'text_top' => '※決勝ブロックの新規登録を実行した時点での各予選ブロックの1位ユーザーが決勝ブロックにエントリーされます。',
            'text_center' => 'よって、各予選ブロック内での順位が確定されてから決勝ブロックの新規登録を行って下さい。',
            'text_bottom' => '※この処理は取り消しまたはキャンセルできません。',
        ],
    ],

    'leagues_tab' => [
        'list' => [
            'title_screen' => '対戦ブロック',
            'league_id' => '対戦ブロックID',
            'title' => 'イベント名',
            'type' => '種別',
            'name' => '対戦ブロック名',
            'entry_start_datetime' => 'エントリー開始日時',
            'entry_end_datetime' => 'エントリー終了日時',
            'entry_fee' => 'エントリー料 ',
            'start_datetime' => '対戦開始日時',
            'end_datetime' => '対戦終了日時',
            'entry_work' => '応募作品',
            'operation' => '操作',
        ],
        'modal_confirm_delete' => [
            'content_title' => '本当にこのイベントを削除して',
            'content_body' => 'よろしいですか？',
        ],
    ],

    'videos_tab' => [
        'list' => [
            'title_screen' => '動画',
            'video_id' => '動画ID',
            'title' => '動画名',
            'thumbnail_url' => 'サムネイル画像',
            'video_url' => '動画',
            'operation' => '操作',
            'search' => '検索',
            'add' => '新規登録',
        ],
        'modal_confirm_delete' => [
            'content_title' => '本当にこの動画を削除して',
            'content_body' => 'よろしいですか？',
        ],
        'add' => [
            'title_screen' => '動画 新規登録',
            'thumbnail_url' => 'サムネイル画像',
            'video_url' => '動画',
            'title' => '動画名',
        ],
    ],

    'withdrawal_tab' => [
        'list' => [
            'title' => '出金申請',
            'created_date_from' => '申請日時（開始）',
            'created_date_to' => '申請日時（終了）',
            'transfer_history_id' => '申請ID',
            'created_at' => '申請日時',
            'user_id' => 'ユーザーID',
            'nickname' => 'ユーザー名',
            'status' => 'ステータス',
            'withdrawal_points' => '出金ポイント',
            'withdrawal_amount' => '出金金額',
            'transfer_fee' => '手数料',
            'transfer_amount' => '振込金額',
            'bank_name' => '銀行名',
            'branch_name' => '支店名',
            'account_type' => '口座種別',
            'account_number' => '口座番号',
            'account_name' => '口座名義',
            'transferred_at' => '振込済み登録日時',
            'operation' => '操作',
            'approve' => '振込済み登録',
        ],
        'unit' => [
            'point' => 'pt',
            'circle' => '円'
        ]
    ],

    'send_mail_tab' => [
        'title' => 'メール送信',
        'title_mail' => 'タイトル *',
        'body' => '本文 *',
        'mail' => 'メール *'
    ]
];
