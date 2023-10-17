<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Card;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::paginate(10);

        return $this->viewData($cards);
    }
 
    public function show($id)
    {
        $card = Card::findOrFail($id);

        return $this->viewData($card);
    }

    public function store(Request $request)
    {
        $card = Card::create($request->all());

        return $this->viewData($card);
    }

    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);
        $card->update($request->all());

        return $this->viewData($card);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Card::whereIn('id', $ids)->delete();

        return 204;
    }
}
