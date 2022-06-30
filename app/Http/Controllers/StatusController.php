<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();

        return $this->viewData($statuses);
    }
 
    public function show($id)
    {
        $status = Status::findOrFail($id);

        return $this->viewData($status);
    }

    public function store(Request $request)
    {
        $status = Status::create($request->all());

        return $this->viewData($status);
    }

    public function update(Request $request, $id)
    {
        $status = Status::findOrFail($id);
        $status->update($request->all());

        return $this->viewData($status);
    }

    public function destroy(Request $request, $id)
    {
        $status = Status::findOrFail($id);
        $status->delete();

        return 204;
    }
}
