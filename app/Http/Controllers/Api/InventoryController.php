<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Inventory;
use App\Models\Item;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('item')->all();

        return $this->viewData($inventories);
    }
 
    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);

        return $this->viewData($inventory);
    }

    public function store(Request $request)
    {
        $inventory = Inventory::create($request->all());

        return $this->viewData($inventory);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());

        return $this->viewData($inventory);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        $item_ids = Inventory::select('item_id')->whereIn('id', $ids)->get();
        
        Inventory::whereIn('id', $ids)->delete();
        Item::whereIn('id', $item_ids)->delete();

        return 204;
    }
}
