<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tax;

class TaxController extends Controller
{
    public function index()
    {
        $taxes = Tax::all();

        return $this->viewData($taxes);
    }
 
    public function show($id)
    {
        $tax = Tax::findOrFail($id);

        return $this->viewData($tax);
    }

    public function store(Request $request)
    {
        $tax = Tax::create($request->all());

        return $this->viewData($tax);
    }

    public function update(Request $request, $id)
    {
        $tax = Tax::findOrFail($id);
        $tax->update($request->all());

        return $this->viewData($tax);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Tax::whereIn('id', $ids)->delete();

        return 204;
    }
}
