<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();

        return $this->viewData($promotions);
    }
 
    public function show($id)
    {
        $promotion = Promotion::findOrFail($id);

        return $this->viewData($promotion);
    }

    public function store(Request $request)
    {
        $promotion = Promotion::create($request->all());

        return $this->viewData($promotion);
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->update($request->all());

        return $this->viewData($promotion);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Promotion::whereIn('id', $ids)->delete();

        return 204;
    }
}
