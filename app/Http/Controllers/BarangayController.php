<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barangay;

class BarangayController extends Controller
{
    public function index()
    {
        $barangays = Barangay::all();

        return $this->viewData($barangays);
    }
 
    public function show($id)
    {
        $barangay = Barangay::findOrFail($id);

        return $this->viewData($barangay);
    }

    public function store(Request $request)
    {
        $barangay = Barangay::create($request->all());

        return $this->viewData($barangay);
    }

    public function update(Request $request, $id)
    {
        $barangay = Barangay::findOrFail($id);
        $barangay->update($request->all());

        return $this->viewData($barangay);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Barangay::whereIn('id', $ids)->delete();

        return 204;
    }
}
