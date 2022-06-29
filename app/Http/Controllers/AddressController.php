<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::all();

        return $this->viewData($addresses);
    }
 
    public function show($id)
    {
        $address = Address::findOrFail($id);

        return $this->viewData($address);
    }

    public function store(Request $request)
    {
        $address = Address::create($request->all());

        return $this->viewData($address);
    }

    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->all());

        return $this->viewData($address);
    }

    public function destroy(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return 204;
    }
}
