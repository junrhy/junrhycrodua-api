<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index() {
        $userProperties = json_decode(Auth::guard('account')->user()->properties);
        $userId = Auth::guard('account')->user()->id;

        $services = Service::whereJsonContains('properties', ['client_id' => $userProperties->client_id])
                        ->whereJsonContains('properties', ['brand_id'  => $userProperties->brand_id])
                        ->whereJsonContains('properties', ['person_id' => $userId])
                        ->get();

        return view('account.service.index')
                ->with('services', $services);
    }

    public function create()
    {
        return view('account.service.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }
        
        $service = new Service;
        $service->name = strtolower($request->name);
        $service->category_id = $request->category_id;
        $service->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id
        ]);

        $service->save();

        return back()->with('status', 'Successfully added!');
    }

    public function edit($id)
    {
        $service = Service::find($id);

        return view('account.service.edit')->with('service', $service);
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }

        $service = Service::find($id);
        $service->name = strtolower($request->name);
        $service->category_id = $request->category_id;
        $service->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id
        ]);

        $service->save();

        return back()->with('status', 'Successfully updated!');
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->forceDelete();
    }
}
