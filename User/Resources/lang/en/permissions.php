<?php

return [
    'admin.users' => [
        'index' => 'UserRepository',
        'create' => 'UserRepository create',
        'update' => 'UserRepository update',
        'blocked' => 'UserRepository block',
    ],

    'admin.roles' => [
        'index' => 'Roles',
        'create' => 'Roles create',
        'update' => 'Roles update',
        'destroy' => 'Roles delete'
    ]
];
