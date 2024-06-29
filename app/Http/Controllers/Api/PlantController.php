<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Plant;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $plant = new Plant;

        if ($request->name) {
            $plant = $plant->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $plants = $plant->get();

        return $this->viewData($plants);
    }
 
    public function show($id)
    {
        $plant = Plant::findOrFail($id);

        return $this->viewData($plant);
    }

    public function store(Request $request)
    {
        $plant = Plant::create($request->all());

        return $this->viewData($plant);
    }

    public function update(Request $request, $id)
    {
        $plant = Plant::findOrFail($id);
        $plant->update($request->all());

        return $this->viewData($plant);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Plant::whereIn('id', $ids)->delete();

        return 204;
    }
}
