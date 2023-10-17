<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
        $states = State::paginate(10);

        return $this->viewData($states);
    }
 
    public function show($id)
    {
        $state = State::findOrFail($id);

        return $this->viewData($state);
    }

    public function store(Request $request)
    {
        $state = State::create($request->all());

        return $this->viewData($state);
    }

    public function update(Request $request, $id)
    {
        $state = State::findOrFail($id);
        $state->update($request->all());

        return $this->viewData($state);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        State::whereIn('id', $ids)->delete();

        return 204;
    }
}
