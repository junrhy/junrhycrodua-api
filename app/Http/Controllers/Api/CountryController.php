<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return $this->viewData($countries);
    }
 
    public function show($id)
    {
        $country = Country::findOrFail($id);

        return $this->viewData($country);
    }

    public function store(Request $request)
    {
        $country = Country::create($request->all());

        return $this->viewData($country);
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->update($request->all());

        return $this->viewData($country);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Country::whereIn('id', $ids)->delete();

        return 204;
    }
}
