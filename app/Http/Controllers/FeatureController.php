<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Feature;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::all();

        return $this->viewData($features);
    }
 
    public function show($id)
    {
        $feature = Feature::findOrFail($id);

        return $this->viewData($feature);
    }

    public function store(Request $request)
    {
        $feature = Feature::create($request->all());

        return $this->viewData($feature);
    }

    public function update(Request $request, $id)
    {
        $feature = Feature::findOrFail($id);
        $feature->update($request->all());

        return $this->viewData($feature);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Feature::whereIn('id', $ids)->delete();

        return 204;
    }
}
