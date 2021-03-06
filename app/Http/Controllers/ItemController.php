<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return $this->viewData($items);
    }
 
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return $this->viewData($item);
    }

    public function store(Request $request)
    {
        $item = Item::create($request->all());

        return $this->viewData($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return $this->viewData($item);
    }

    public function destroy(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return 204;
    }
}
