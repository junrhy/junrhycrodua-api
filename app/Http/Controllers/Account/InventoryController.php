<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index() {
        $userProperties = json_decode(Auth::guard('account')->user()->properties);
        $userId = Auth::guard('account')->user()->id;

        $inventories = Inventory::whereJsonContains('properties', ['client_id' => $userProperties->client_id])
                                ->whereJsonContains('properties', ['brand_id'  => $userProperties->brand_id])
                                ->whereJsonContains('properties', ['person_id' => $userId])
                                ->get();

        return view('account.inventory.index')
                ->with('inventories', $inventories);
    }

    public function create()
    {
        return view('account.inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required',
            'currency' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'status' => 'required',
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }
        
        $inventory = new Inventory;
        $inventory->name = strtolower($request->item_name);
        $inventory->item_code = preg_replace('/\s+/', '',  $request->item_code);
        $inventory->purchase_price = $request->purchase_price;
        $inventory->selling_price = $request->selling_price;
        $inventory->currency = $request->currency;
        $inventory->qty = $request->qty;
        $inventory->unit = strtolower($request->unit);
        $inventory->status = $request->status;
        $inventory->note = $request->note;
        $inventory->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id
        ]);
        $inventory->save();

        return back()->with('status', 'Successfully added!');
    }

    public function edit($id)
    {
        $inventory = Inventory::find($id);

        return view('account.inventory.edit')->with('inventory', $inventory);
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required',
            'currency' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'status' => 'required',
        ]);

        $inventory = Inventory::find($id);
        $inventory->name = strtolower($request->item_name);
        $inventory->item_code = preg_replace('/\s+/', '',  $request->item_code);
        $inventory->purchase_price = $request->purchase_price;
        $inventory->selling_price = $request->selling_price;
        $inventory->currency = $request->currency;
        $inventory->qty = $request->qty;
        $inventory->unit = strtolower($request->unit);
        $inventory->status = $request->status;
        $inventory->note = $request->note;
        $inventory->save();

        return back()->with('status', 'Successfully updated!');
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->forceDelete();
    }
}
