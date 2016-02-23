<?php

return [
    ['id' => 1, 'name' => 'Store', 'slug' => 'store', '_lft' => 1, '_rgt' => 20, 'parent_id' => null],
        ['id' => 2, 'name' => 'notebooks', 'slug' => 'notebooks', '_lft' => 2, '_rgt' => 7, 'parent_id' => 1],
            ['id' => 3, 'name' => 'Apple', 'slug' => 'apple', '_lft' => 3, '_rgt' => 4, 'parent_id' => 2],
            ['id' => 4, 'name' => 'Lenovo', 'slug' => 'lenovo', '_lft' => 5, '_rgt' => 6, 'parent_id' => 2],
        ['id' => 5, 'name' => 'Mobile', 'slug' => 'mobile', '_lft' => 8, '_rgt' => 19, 'parent_id' => 1],
            ['id' => 6, 'name' => 'Nokia', 'slug' => 'nokia', '_lft' => 9, '_rgt' => 10, 'parent_id' => 5],
            ['id' => 7, 'name' => 'Samsung', 'slug' => 'samsung', '_lft' => 11, '_rgt' => 14, 'parent_id' => 5],
                ['id' => 8, 'name' => 'Galaxy', 'slug' => 'galaxy', '_lft' => 12, '_rgt' => 13, 'parent_id' => 7],
            ['id' => 9, 'name' => 'Sony', 'slug' => 'sony', '_lft' => 15, '_rgt' => 16, 'parent_id' => 5],
    ['id' => 11, 'name' => 'Store 2', 'slug' => 'store-2', '_lft' => 21, '_rgt' => 22, 'parent_id' => null],
];
