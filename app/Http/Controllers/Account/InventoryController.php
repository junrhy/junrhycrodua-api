<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index() {
        $inventories = Inventory::all();

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
            'price' => 'required',
            'currency' => 'required',
            'qty' => 'required',
            'unit' => 'required',
        ]);

        $inventory = new Inventory;
        $inventory->name = strtolower($request->item_name);
        $inventory->item_code = preg_replace('/\s+/', '', strtolower($request->unit . $request->item_name));
        $inventory->price = $request->price;
        $inventory->currency = $request->currency;
        $inventory->qty = $request->qty;
        $inventory->unit = strtolower($request->unit);
        $inventory->status = 'IN';
        $inventory->properties = json_encode([
            'person_id' => Auth::guard('account')->user()->id,
            'client_id' => $this->getJsonKey(Auth::guard('account')->user()->properties, 'client_id'),
            'brand_id' => $this->getJsonKey(Auth::guard('account')->user()->properties, 'brand_id')
        ]);
        $inventory->save();

        return back()->withInput();
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
            'price' => 'required',
            'currency' => 'required',
            'qty' => 'required',
            'unit' => 'required',
        ]);

        $inventory = Inventory::find($id);
        $inventory->name = strtolower($request->item_name);
        $inventory->item_code = preg_replace('/\s+/', '', strtolower($request->unit . $request->item_name));
        $inventory->price = $request->price;
        $inventory->currency = $request->currency;
        $inventory->qty = $request->qty;
        $inventory->unit = strtolower($request->unit);
        $inventory->save();

        return back()->withInput();
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);

        $inventory = Inventory::where('item_id', $inventory->item_id);
        $inventory->forceDelete();

        $item = Item::find($inventory->item_id);
        $item->forceDelete();
    }

    private function getJsonKey($json, $key)
    {
        $json = json_decode($json, true);

        return $json[$key];
    }
}
