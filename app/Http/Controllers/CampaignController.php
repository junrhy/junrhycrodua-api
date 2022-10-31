<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();

        return $this->viewData($campaigns);
    }
 
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);

        return $this->viewData($campaign);
    }

    public function store(Request $request)
    {
        $campaign = Campaign::create($request->all());

        return $this->viewData($campaign);
    }

    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->all());

        return $this->viewData($campaign);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Campaign::whereIn('id', $ids)->delete();

        return 204;
    }
}
