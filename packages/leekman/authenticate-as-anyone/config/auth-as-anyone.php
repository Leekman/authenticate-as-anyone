<?php

return [
    'route-prefix' => 'authenticate-as-anyone',
    'middlewares' =>
        [
            'auth',
        ],
    'models-path' => 'App\Models',
    'models' =>
        [
            [
                'User' =>
                    [
                        'columns' => [
                            'name' => 'name',
                            'firstname' => 'firstname',
                            'login' => 'email',
                        ],
                        'model-pretty-name' => 'Users',
                    ],
                'Admin' =>
                    [
                        'columns' => [
                            'name' => 'nom',
                            'firstname' => 'prenom',
                            'login' => 'email',
                        ],
                        'model-pretty-name' => 'Administrators',
                    ],
                'Owner' =>
                    [
                        'columns' => [
                            'name' => 'nom_utilisateur',
                            'firstname' => 'prenom_utilisateur',
                            'login' => 'email',
                        ],
                        'model-pretty-name' => 'Owners',
                    ],
            ],
        ],
];
