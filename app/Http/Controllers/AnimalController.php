<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Animal;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $animal = new Animal;

        if ($request->name) {
            $animal = $animal->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $animals = $animal->orderBy('name', 'asc')->get();

        return $this->viewData($animals);
    }
 
    public function show($id)
    {
        $animal = Animal::findOrFail($id);

        return $this->viewData($animal);
    }

    public function store(Request $request)
    {
        $animal = Animal::create($request->all());

        return $this->viewData($animal);
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->update($request->all());

        return $this->viewData($animal);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Animal::whereIn('id', $ids)->delete();

        return 204;
    }
}
