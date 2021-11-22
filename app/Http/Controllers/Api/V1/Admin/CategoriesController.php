<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|unique:categories|string',
                'description' => 'required|string'
            ]);

            $category = Category::create($validated);

            if (!$category) {
                return response()->json(['message' => 'Request data is not valid']);
            }

            return response()->json(['category' => $category]);
        } catch (QueryException $exception) {
                return response()->json(['message' => $exception->getMessage()], 422);
        }
    }

    public function delete(Category $category)
    {
        try {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully'],202);
        } catch (QueryException $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        }
    }
}
