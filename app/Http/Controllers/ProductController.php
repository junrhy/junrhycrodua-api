<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return $this->viewData($products);
    }
 
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return $this->viewData($product);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return $this->viewData($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return $this->viewData($product);
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return 204;
    }
}
