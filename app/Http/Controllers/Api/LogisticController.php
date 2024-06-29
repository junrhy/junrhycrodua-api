<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Logistic::whereIn('id', $ids)->delete();

        return 204;
    }
}
