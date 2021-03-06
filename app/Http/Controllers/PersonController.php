<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Person;

class PersonController extends Controller
{
    public function index()
    {
        $persons = Person::all();

        return $this->viewData($persons);
    }
 
    public function show($id)
    {
        $person = Person::findOrFail($id);

        return $this->viewData($person);
    }

    public function store(Request $request)
    {
        $person = Person::create($request->all());

        return $this->viewData($person);
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->update($request->all());

        return $this->viewData($person);
    }

    public function destroy(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return 204;
    }
}
