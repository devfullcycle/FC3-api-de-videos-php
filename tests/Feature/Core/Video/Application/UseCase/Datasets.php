<?php

dataset('elastic_data', [
    'empty' => [[], 0],
    'one records' => [
        [
            [
                '_source' => [
                    'after' => [
                        'id' => '25aeaffa-942c-4bf1-9b74-a9ef2a9a7c7e',
                        'title' => 'Video Title',
                        'description' => 'Desc',
                        'year_launched' => 2024,
                        'duration' => 1,
                        'rating' => 'L',
                        'opened' => 1,
                        'published' => 1,
                        'created_at' => '2023-06-22T14:27:33Z',
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
                        'id' => '25aeaffa-942c-4bf1-9b74-a9ef2a9a7c7e',
                        'title' => 'Video Title',
                        'description' => 'Desc',
                        'year_launched' => 2024,
                        'duration' => 1,
                        'rating' => 'L',
                        'opened' => 1,
                        'published' => 1,
                        'created_at' => '2023-06-22T14:27:33Z',
                    ]
                ]
            ],
            [
                '_source' => [
                    'after' => [
                        'id' => 'e37a3997-673f-4a0f-816d-31ebfd302cfd',
                        'title' => 'Video Title2',
                        'description' => 'Desc2',
                        'year_launched' => 2025,
                        'duration' => 1,
                        'rating' => 'L',
                        'opened' => 1,
                        'published' => 1,
                        'created_at' => '2023-06-22T14:27:33Z',
                    ]
                ]
            ],
        ],
        2
    ],
]);
