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
                    'guard' => 'web',
                    'namespace' => 'App\Models',
                    'columns' => [
                        'id' => 'id',
                        'name' => 'name',
                        'firstname' => 'firstname',
                        'login' => 'email',
                    ],
                    'pretty-name' => 'Users',
                ],
            'Admin' =>
                [
                    'guard' => 'admin',
                    'namespace' => 'App\Models',
                    'columns' => [
                        'id' => 'id',
                        'name' => 'nom_admin',
                        'firstname' => 'prenom_admin',
                        'login' => 'email',
                    ],
                    'pretty-name' => 'Administrators',
                ],
            'Owner' =>
                [
                    'guard' => 'owner',
                    'namespace' => 'App\Models',
                    'columns' => [
                        'id' => 'id',
                        'name' => 'nom_utilisateur',
                        'firstname' => 'prenom_utilisateur',
                        'login' => 'email',
                    ],
                    'pretty-name' => 'Owners',
                ],
        ],
];
