<?php

namespace App\Service\Categories;

class Category {

    public function __construct(
        protected int $index,
        protected string $category,
        protected string $translationPrefix,
    ) {}

}
