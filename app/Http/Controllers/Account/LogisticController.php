<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Logistic;

class LogisticController extends Controller
{
    public function index() {
        $userProperties = json_decode(Auth::guard('account')->user()->properties);
        $userId = Auth::guard('account')->user()->id;

        $logistics = Logistic::whereJsonContains('properties', ['client_id' => $userProperties->client_id])
                        ->whereJsonContains('properties', ['brand_id'  => $userProperties->brand_id])
                        ->whereJsonContains('properties', ['person_id' => $userId])
                        ->get();

        return view('account.logistic.index')
                ->with('logistics', $logistics);
    }

    public function create()
    {
        return view('account.logistic.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip' => 'required',
            'contact_person' => 'required',
            'truck' => 'required',
            'driver' => 'required',
            'status' => 'required'
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }
        
        $logistic = new Logistic;
        $logistic->trip = $request->trip;
        $logistic->contact_person = $request->contact_person;
        $logistic->truck = $request->truck;
        $logistic->driver = $request->driver;
        $logistic->trailer = $request->trailer;
        $logistic->distance = $request->distance;
        $logistic->weight = $request->weight;
        $logistic->pieces = $request->pieces;
        $logistic->amount = $request->amount;
        $logistic->origin = $request->origin;
        $logistic->loaded_at = $request->loaded_at;
        $logistic->pickup_at = $request->pickup_at;
        $logistic->destination = $request->destination;
        $logistic->drop_at = $request->drop_at;
        $logistic->arrived_at = $request->arrived_at;
        $logistic->unloaded_at = $request->unloaded_at;
        $logistic->journey = $request->journey;
        $logistic->status = $request->status;
        $logistic->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id
        ]);
        $logistic->save();

        return back()->with('status', 'Successfully added!');
    }

    public function edit($id)
    {
        $logistic = Logistic::find($id);

        return view('account.logistic.edit')->with('logistic', $logistic);
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'trip' => 'required',
            'contact_person' => 'required',
            'truck' => 'required',
            'driver' => 'required',
            'status' => 'required'
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }

        $logistic = Logistic::find($id);
        $logistic->trip = $request->trip;
        $logistic->contact_person = $request->contact_person;
        $logistic->truck = $request->truck;
        $logistic->driver = $request->driver;
        $logistic->trailer = $request->trailer;
        $logistic->distance = $request->distance;
        $logistic->weight = $request->weight;
        $logistic->pieces = $request->pieces;
        $logistic->amount = $request->amount;
        $logistic->origin = $request->origin;
        $logistic->loaded_at = $request->loaded_at;
        $logistic->pickup_at = $request->pickup_at;
        $logistic->destination = $request->destination;
        $logistic->drop_at = $request->drop_at;
        $logistic->arrived_at = $request->arrived_at;
        $logistic->unloaded_at = $request->unloaded_at;
        $logistic->journey = $request->journey;
        $logistic->status = $request->status;
        $logistic->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id
        ]);
        $logistic->save();

        return back()->with('status', 'Successfully updated!');
    }

    public function destroy($id)
    {
        $logistic = Logistic::find($id);
        $logistic->forceDelete();
    }
}
