<?php

const CREDENTIALS = [
    'admin' => [
        'valid' => [
            'username' => 'admin',
            'password' => 'admin',
        ],
        'invalid' => [
            'notfoundUsername' => [
                'username' => 'somenotfoundusername',
                'password' => 'admin'
            ],
            'invalidUsername' => [
                'email' => 'dev@null',
                'password' => 'admin'
            ]
        ]
    ],
    'client' => [
        'valid' => [
            'email' => 'antonio.dibbert@hotmail.com',
            'password' => 123456,
        ],
        'invalid' => [
            'notfoundEmail' => [
                'email' => 'dev@null.mail',
                'password' => 123456
            ],
            'invalidEmail' => [
                'email' => 'dev@null',
                'password' => 123456
            ]
        ],
    ]
];