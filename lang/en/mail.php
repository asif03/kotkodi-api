<?php

return [
    'registration' => [
        'subject' => 'Kotkodi user Registration',
        'dear_concern' => 'Dear Concern,',
        'please_click' => 'Please click the URL below, enter the required information, and log in within '.env('URL_EXPIRES_AT').' minutes.',
        'redirect_page' => 'Redirect page URL',
        'email_sending' => '* This e-mail address is for sending only. Even if you reply to this email, we will not be able to reply. Please note.',
        'email_delete' => 'If you do not know this email, please delete it.',
    ],
    'change_email' => [
        'subject' => 'Qoffee Change Email',
        'please_click' => 'Please click the URL below for verify new email, link will be valid for '.env('URL_EXPIRES_AT').' minutes.',
    ],
    'forgot_password' => [
        'subject' => 'Qoffee Forgot Password',
        'please_click' => 'Please click the URL below for changing password, URL will be valid for '.env('URL_EXPIRES_AT').' minutes.',
    ],
    'reset_password' => [
        'subject' => 'Qoffee Reset Password',
    ],
    'admin_invitation' => [
        'please_click' => 'Please click the URL below for confirming invitation and password reset. URL will be valid for '.env('URL_EXPIRES_AT').' minutes.',
    ]
];
