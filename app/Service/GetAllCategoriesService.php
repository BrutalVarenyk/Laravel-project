<?php

namespace App\Service;

use App\Models\Category;

class GetAllCategoriesService implements GetAllCategoriesServiceInterface
{

    public static function getAllCategories()
    {
        $categories = Category::get();
//        dd($categories);
        return $categories;
    }
}
