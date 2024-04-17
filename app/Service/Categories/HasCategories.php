<?php

namespace App\Service\Categories;

trait HasCategories {

    static public function getCategoryTranslations() {
        $categories = [];
        foreach (static::getCategories() as $index => $category) {
            $categories[$category] = new Category($index, $category, static::$category_prefix);
        }

        return $categories;
    }

}
