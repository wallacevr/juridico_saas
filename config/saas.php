<?php

return [
    'trial_days' => 14,

    'plans' => [
        'price_1JLCiMCcZsxaGzjvGWTZwgtk' => 'Medio — R$ 300.00 BRL',
        'price_1JLCiACcZsxaGzjv2kg3yhzx' => 'Inicial — R$ 99.00',
    ],

    'cancelation_reasons' => [
        'Too expensive',
        'Lacks features',
        'Not what I expected',
    ],

    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
];
