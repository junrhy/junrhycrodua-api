<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::paginate(10);

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

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Plan::whereIn('id', $ids)->delete();

        return 204;
    }
}
