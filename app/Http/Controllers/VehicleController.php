<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();

        return $this->viewData($vehicles);
    }
 
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return $this->viewData($vehicle);
    }

    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->all());

        return $this->viewData($vehicle);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());

        return $this->viewData($vehicle);
    }

    public function destroy(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return 204;
    }
}
