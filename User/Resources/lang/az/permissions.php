<?php

return [
    'users' => [
        'index' => 'UserRepository',
        'create' => 'UserRepository create',
        'edit' => 'UserRepository edit',
        'blocked' => 'UserRepository block',
    ],

    'roles' => [
        'index' => 'Roles',
        'create' => 'Roles create',
        'edit' => 'Roles edit',
        'destroy' => 'Roles delete'
    ]
];
