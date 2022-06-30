<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return $this->viewData($categories);
    }
 
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return $this->viewData($category);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return $this->viewData($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return $this->viewData($category);
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return 204;
    }
}
