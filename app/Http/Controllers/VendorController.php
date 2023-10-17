<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vendor;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::paginate(10);

        return $this->viewData($vendors);
    }
 
    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);

        return $this->viewData($vendor);
    }

    public function store(Request $request)
    {
        $vendor = Vendor::create($request->all());

        return $this->viewData($vendor);
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());

        return $this->viewData($vendor);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Vendor::whereIn('id', $ids)->delete();

        return 204;
    }
}
