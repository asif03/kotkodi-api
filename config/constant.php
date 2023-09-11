<?php

return [

    'pagination_records' => 10,
    'admin_role' => 2,
    'user_role' => 1,
    'failed_common_message' => 'Operation Failed',
    'token_bit_number' => 32,
    'expires_in_time_multiplier' => 60,
    'image_download_path' => env('SWAGGER_LUME_CONST_HOST') . '/image/',
    'image_store_path' => '',
    'langs' => [
        'english' => 'en',
        'japanese' => 'jp'
    ],
    'pagination_records_pickup_setting_list' => 20,
    'pagination_records_review_list' => 20,
    'ttl_minutes' => 1,
];

