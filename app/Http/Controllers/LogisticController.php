<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Logistic;

class LogisticController extends Controller
{
    public function index()
    {
        $logistics = Logistic::all();

        return $this->viewData($logistics);
    }
 
    public function show($id)
    {
        $logistic = Logistic::findOrFail($id);

        return $this->viewData($logistic);
    }

    public function store(Request $request)
    {
        $logistic = Logistic::create($request->all());

        return $this->viewData($logistic);
    }

    public function update(Request $request, $id)
    {
        $logistic = Logistic::findOrFail($id);
        $logistic->update($request->all());

        return $this->viewData($logistic);
    }

    public function destroy(Request $request, $id)
    {
        $logistic = Logistic::findOrFail($id);
        $logistic->delete();

        return 204;
    }
}
