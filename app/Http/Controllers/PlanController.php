<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();

        return $this->viewData($plans);
    }
 
    public function show($id)
    {
        $plan = Plan::findOrFail($id);

        return $this->viewData($plan);
    }

    public function store(Request $request)
    {
        $plan = Plan::create($request->all());

        return $this->viewData($plan);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->update($request->all());

        return $this->viewData($plan);
    }

    public function destroy(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return 204;
    }
}
