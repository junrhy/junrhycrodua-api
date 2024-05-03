<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agent;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all();

        return $this->viewData($agents);
    }
 
    public function show($id)
    {
        $agent = Agent::findOrFail($id);

        return $this->viewData($agent);
    }

    public function store(Request $request)
    {
        $agent = Agent::create($request->all());

        return $this->viewData($agent);
    }

    public function update(Request $request, $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->update($request->all());

        return $this->viewData($agent);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Agent::whereIn('id', $ids)->delete();

        return 204;
    }
}
