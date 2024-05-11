<?php

return [
    'customers' => [
        /**
         * Se os clientes podem criar uma conta eles próprios
         * Se 'false', apenas um admin poderá cadastrar um cliente
         */
        'can_self_register' => (bool) env('CUSTOMER_CAN_SELF_REGISTER', true),

        'hesk_customer_login_url' => env('HESK_CUSTOMER_LOGIN_URL', 'http://hesk.local'),
    ],
];
