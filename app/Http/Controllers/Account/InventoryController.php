<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
use App\Models\Item;

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

    public function edit()
    {
        return view('account.inventory.edit');
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

        $item = new Item;
        $item->user_id = 1; // to remove
        $item->name = $request->item_name;
        $item->item_code = $request->item_name;
        $item->price = $request->price;
        $item->currency = $request->currency;
        $item->properties = json_encode([
            'person_id' => Auth::guard('account')->user()->id,
            'client_id' => $this->getJsonKey(Auth::guard('account')->user()->properties, 'client_id'),
            'brand_id' => $this->getJsonKey(Auth::guard('account')->user()->properties, 'brand_id')
        ]);
        $item->save();

        $inventory = new Inventory;
        $inventory->item_id = $item->id;
        $inventory->qty = $request->qty;
        $inventory->unit = $request->unit;
        $inventory->operator = 'add';
        $inventory->save();

        return back()->withInput();
    }

    public function destroy($id)
    {
        $inventory = Inventory::where('item_id', $id);
        $inventory->forceDelete();

        $item = Item::find($id);
        $item->forceDelete();
    }

    private function getJsonKey($json, $key)
    {
        $json = json_decode($json, true);

        return $json[$key];
    }
}
