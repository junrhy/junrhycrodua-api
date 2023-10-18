<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(10);

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

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Item::whereIn('id', $ids)->delete();

        return 204;
    }
}
