<?php

namespace App\Services\GetAllCategories;

use App\Models\Category;

class GetAllCategoriesService implements GetAllCategoriesServiceInterface
{

    public static function getAllCategories()
    {
        $categories = Category::get();
        return $categories;
    }
}
