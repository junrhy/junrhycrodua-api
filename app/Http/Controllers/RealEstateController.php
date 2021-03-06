<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RealEstate;

class RealEstateController extends Controller
{
    public function index()
    {
        $realEstates = RealEstate::all();

        return $this->viewData($realEstates);
    }
 
    public function show($id)
    {
        $realEstate = RealEstate::findOrFail($id);

        return $this->viewData($realEstate);
    }

    public function store(Request $request)
    {
        $realEstate = RealEstate::create($request->all());

        return $this->viewData($realEstate);
    }

    public function update(Request $request, $id)
    {
        $realEstate = RealEstate::findOrFail($id);
        $realEstate->update($request->all());

        return $this->viewData($realEstate);
    }

    public function destroy(Request $request, $id)
    {
        $realEstate = RealEstate::findOrFail($id);
        $realEstate->delete();

        return 204;
    }
}
