<?php
return [
    'createRoom' => [
        'type' => 2,
        'description' => 'Create a room',
    ],
    'updateRoom' => [
        'type' => 2,
        'description' => 'Update room',
    ],
    'operator' => [
        'type' => 1,
        'children' => [
            'createRoom',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'updateRoom',
            'operator',
        ],
    ],
];
