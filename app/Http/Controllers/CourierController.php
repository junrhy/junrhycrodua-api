<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Courier;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::paginate(10);

        return $this->viewData($couriers);
    }
 
    public function show($id)
    {
        $courier = Courier::findOrFail($id);

        return $this->viewData($courier);
    }

    public function store(Request $request)
    {
        $courier = Courier::create($request->all());

        return $this->viewData($courier);
    }

    public function update(Request $request, $id)
    {
        $courier = Courier::findOrFail($id);
        $courier->update($request->all());

        return $this->viewData($courier);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Courier::whereIn('id', $ids)->delete();

        return 204;
    }
}
