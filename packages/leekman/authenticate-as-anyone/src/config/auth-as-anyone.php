<?php

return [
    'route-prefix' => 'authenticate-as-anyone',
    'middlewares' =>
        [
            'auth:admin',
        ],
    'guards' =>
        [
            [
                'User' =>
                    [
                        'name' => 'name',
                        'firstname' => 'firstname',
                        'guard-name' => 'Utilisateurs'
                    ],
            ],
        ],
];
