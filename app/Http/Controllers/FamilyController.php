<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Family;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::all();

        return $this->viewData($families);
    }
 
    public function show($id)
    {
        $family = Family::findOrFail($id);

        return $this->viewData($family);
    }

    public function store(Request $request)
    {
        $family = Family::create($request->all());

        return $this->viewData($family);
    }

    public function update(Request $request, $id)
    {
        $family = Family::findOrFail($id);
        $family->update($request->all());

        return $this->viewData($family);
    }

    public function destroy(Request $request, $id)
    {
        $family = Family::findOrFail($id);
        $family->delete();

        return 204;
    }
}
