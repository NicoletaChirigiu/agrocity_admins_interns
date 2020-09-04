<?php

return [
    'db' => [
        'connection' => 'mysql:host=localhost',
        'name' => 'log_form_agrocity',
        'username' => 'root',
        'password' => '',
        'exception' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    ]
];
