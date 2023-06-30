<?php

dataset('elastic_data', [
    'empty' => [[], 0],
    'one records' => [
        [
            [
                '_source' => [
                    'after' => [
                        'id' => '88bdf4aa-7ec7-408f-91f6-c82f192d540c',
                        'name' => 'name',
                        'description' => 'description',
                        'is_active' => 1,
                        'created_at' => '2023-12-12 12:12:00',
                    ]
                ]
            ]
        ],
        1
    ],
    'two records' => [
        [
            [
                '_source' => [
                    'after' => [
                        'id' => '88bdf4aa-7ec7-408f-91f6-c82f192d540c',
                        'name' => 'name',
                        'description' => 'description',
                        'is_active' => 1,
                        'created_at' => '2023-12-12 12:12:00',
                    ]
                ]
            ],
            [
                '_source' => [
                    'after' => [
                        'id' => '88bdf4aa-7ec7-408f-91f6-c82f192d540c',
                        'name' => 'name2',
                        'description' => 'description2',
                        'is_active' => 0,
                        'created_at' => '2023-12-12 12:12:00',
                    ]
                ]
            ],
        ],
        2
    ],
]);
