<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();

        return $this->viewData($sales);
    }
 
    public function show($id)
    {
        $sale = Sale::findOrFail($id);

        return $this->viewData($sale);
    }

    public function store(Request $request)
    {
        $sale = Sale::create($request->all());

        return $this->viewData($sale);
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $sale->update($request->all());

        return $this->viewData($sale);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Sale::whereIn('id', $ids)->delete();

        return 204;
    }
}
