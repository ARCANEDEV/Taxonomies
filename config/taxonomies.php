<?php

return [
    'database' => [
        'connection' => null,
        'prefix'     => null,
    ],

    'categories' => [
        'table'       => 'categories',
        'model'       => \Arcanedev\Taxonomies\Models\Category::class,
        'morph' => [
            'name'  => 'categorizable',
            'table' => 'categories_relations',
        ],
    ],
];
