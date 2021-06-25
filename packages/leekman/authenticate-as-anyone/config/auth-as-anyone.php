<?php

return [
    'route-prefix' => 'authenticate-as-anyone',
    'middlewares' =>
        [
            'auth',
        ],
    'models' =>
        [
            'User' =>
                [
                    'namespace' => 'App\Models',
                    'columns' => [
                        'name' => 'name',
                        'firstname' => 'firstname',
                        'login' => 'email',
                    ],
                    'pretty-name' => 'Users',
                ],
            'Admin' =>
                [
                    'namespace' => 'App\Models',
                    'columns' => [
                        'name' => 'nom_admin',
                        'firstname' => 'prenom_admin',
                        'login' => 'email',
                    ],
                    'pretty-name' => 'Administrators',
                ],
            'Owner' =>
                [
                    'namespace' => 'App\Models',
                    'columns' => [
                        'name' => 'nom_utilisateur',
                        'firstname' => 'prenom_utilisateur',
                        'login' => 'email',
                    ],
                    'pretty-name' => 'Owners',
                ],
        ],
];
