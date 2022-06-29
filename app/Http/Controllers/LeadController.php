<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lead;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::all();

        return $this->viewData($leads);
    }
 
    public function show($id)
    {
        $lead = Lead::findOrFail($id);

        return $this->viewData($lead);
    }

    public function store(Request $request)
    {
        $lead = Lead::create($request->all());

        return $this->viewData($lead);
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update($request->all());

        return $this->viewData($lead);
    }

    public function destroy(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return 204;
    }
}
