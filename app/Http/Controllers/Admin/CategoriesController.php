<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function edit(Category $category)
    {
        return view('admin/categories/edit', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.new');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|string',
            'description' => 'required|string'
        ]);

        Category::create($validated);

        return redirect()->route('lang.categories')
            ->with('status', __('Category created successfully'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'unique:categories',
                'string',
                Rule::unique('products', 'title')->ignore($category->id)
            ],
            'description' => ['required', 'string']
        ]);

        $category->update($validated);

        return redirect()->route('lang.categories')
            ->with('status', __('Category [' . $category->name . '] updated successfully'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('lang.categories')->with('status', __('Category deleted successfully'));
    }

}
