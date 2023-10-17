<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(10);

        return $this->viewData($brands);
    }
 
    public function show($id)
    {
        $brand = Brand::findOrFail($id);

        return $this->viewData($brand);
    }

    public function store(Request $request)
    {
        $brand = Brand::create($request->all());

        return $this->viewData($brand);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        return $this->viewData($brand);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Brand::whereIn('id', $ids)->delete();

        return 204;
    }
}
