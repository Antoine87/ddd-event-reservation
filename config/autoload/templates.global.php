<?php

declare(strict_types=1);

return [
    'templates' => [
        'layout' => 'layout::app',
        'paths' => [
            'app'         => ['templates/app'],
            'reservation' => ['templates/app/reservation'],
            'error'       => ['templates/error'],
            'layout'      => ['templates/layout'],
            'mail'        => ['templates/mail'],
        ],
    ],
];
