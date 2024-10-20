<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->withCount('books')
            ->get();

        return Inertia::render('Category/Index', [
            'categories' => $categories,
        ]);
    }

    public function store(CategoryRequest $request)
    {
        Category::query()
            ->create($request->validated());

        return to_route('category.index');
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();

        return to_route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('category.index');
    }
}
