<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Town;

class TownController extends Controller
{
    public function index()
    {
        $towns = Town::all();

        return $this->viewData($towns);
    }
 
    public function show($id)
    {
        $town = Town::findOrFail($id);

        return $this->viewData($town);
    }

    public function store(Request $request)
    {
        $town = Town::create($request->all());

        return $this->viewData($town);
    }

    public function update(Request $request, $id)
    {
        $town = Town::findOrFail($id);
        $town->update($request->all());

        return $this->viewData($town);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Town::whereIn('id', $ids)->delete();

        return 204;
    }
}
