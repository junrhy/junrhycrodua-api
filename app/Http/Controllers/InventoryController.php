<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::paginate(10);

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
        Inventory::whereIn('id', $ids)->delete();

        return 204;
    }
}
