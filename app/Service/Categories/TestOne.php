<?php

namespace App\Service\Categories;

class TestOne extends BaseTest {

    static public string $category_prefix = 'test_one.categories.';

    static public function getCategories() : array {
        return [
            'one',
            'two',
            'three',
        ];
    }

}
