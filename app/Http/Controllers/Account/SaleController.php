<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index() {
        $userProperties = json_decode(Auth::guard('account')->user()->properties);
        $userId = Auth::guard('account')->user()->id;

        $sales = Sale::whereJsonContains('properties', ['client_id' => $userProperties->client_id])
                        ->whereJsonContains('properties', ['brand_id'  => $userProperties->brand_id])
                        ->whereJsonContains('properties', ['person_id' => $userId])
                        ->get();

        return view('account.sale.index')
                ->with('sales', $sales);
    }

    public function create()
    {
        return view('account.sale.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'source' => 'required',
            'items' => 'required',
            'amount' => 'required',
            'payment_type' => 'required',
            'status' => 'required'
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }
        
        $sale = new Sale;
        $sale->source = strtolower($request->source);
        $sale->items = $request->items;
        $sale->amount = $request->amount;
        $sale->discount = $request->discount;
        $sale->fees = $request->fees;
        $sale->tax = $request->tax;
        $sale->payment_type = $request->payment_type;
        $sale->payment_tracking_code = $request->payment_tracking_code;
        $sale->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id
        ]);
        $sale->status = $request->status;
        $sale->save();

        return back()->with('status', 'Successfully added!');
    }

    public function edit($id)
    {
        $sale = Sale::find($id);

        return view('account.sale.edit')->with('sale', $sale);
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'source' => 'required',
            'items' => 'required',
            'amount' => 'required',
            'payment_type' => 'required',
            'status' => 'required'
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }

        $sale = Sale::find($id);
        $sale->source = strtolower($request->source);
        $sale->items = $request->items;
        $sale->amount = $request->amount;
        $sale->discount = $request->discount;
        $sale->fees = $request->fees;
        $sale->tax = $request->tax;
        $sale->payment_type = $request->payment_type;
        $sale->payment_tracking_code = $request->payment_tracking_code;
        $sale->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id
        ]);
        $sale->status = $request->status;
        $sale->save();

        return back()->with('status', 'Successfully updated!');
    }

    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->forceDelete();
    }
}
