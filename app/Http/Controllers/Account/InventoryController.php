<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $item = new Item;
        $item->name = $request->item_name;
        $item->save();

        $itemId = $item->lastInsertId();

        $inventory = new Inventory;
        $inventory->item_id = $itemId;
        $inventory->operator = $request->operator; // + or -

        $inventory->properties = json_encode([
            'person_id' => Auth::guard('account')->user()->id,
            'client_id' => '',
            'brand_id' => ''
        ]);

        $inventory->properties = $properties;

        $inventory->save();
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->forceDelete();
    }
}
