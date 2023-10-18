<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Province;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::paginate(10);

        return $this->viewData($provinces);
    }
 
    public function show($id)
    {
        $province = Province::findOrFail($id);

        return $this->viewData($province);
    }

    public function store(Request $request)
    {
        $province = Province::create($request->all());

        return $this->viewData($province);
    }

    public function update(Request $request, $id)
    {
        $province = Province::findOrFail($id);
        $province->update($request->all());

        return $this->viewData($province);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Province::whereIn('id', $ids)->delete();

        return 204;
    }
}
