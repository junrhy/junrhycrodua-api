<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        $userProperties = json_decode(Auth::guard('account')->user()->properties);
        $userId = Auth::guard('account')->user()->id;

        $orders = Order::whereJsonContains('properties', ['client_id' => $userProperties->client_id])
                        ->whereJsonContains('properties', ['brand_id'  => $userProperties->brand_id])
                        ->whereJsonContains('properties', ['person_id' => $userId])
                        ->get();

        return view('account.order.index')
                ->with('orders', $orders);
    }

    public function create()
    {
        return view('account.order.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'source' => 'required',
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }
        
        $order = new Order;
        $order->name = strtolower($request->item_name);
        $order->source = $request->source;
        $order->status = $request->status;
        $order->type = $request->type;
        $order->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id,
            'qty' => $request->qty,
            'unit' => strtolower($request->unit),
            'price' => $request->price
        ]);

        if ($request->status == 'served') {
            $order->served = date('Y-m-d');
        } else if ($request->status == 'cancelled') {
            $order->cancelled = date('Y-m-d');
        }

        $order->save();

        return back()->with('status', 'Successfully added!');
    }

    public function edit($id)
    {
        $order = Order::find($id);

        return view('account.order.edit')->with('order', $order);
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'source' => 'required',
        ]);

        $accountType = json_decode(Auth::guard('account')->user()->properties)->type;

        if ($accountType == 'staff') {
            $personId = json_decode(Auth::guard('account')->user()->properties)->person_id;
        } else {
            $personId = Auth::guard('account')->user()->id;
        }

        $order = Order::find($id);
        $order->name = strtolower($request->item_name);
        $order->source = $request->source;
        $order->status = $request->status;
        $order->type = $request->type;
        $order->properties = json_encode([
            'person_id' => $personId,
            'client_id' => json_decode(Auth::guard('account')->user()->properties)->client_id,
            'brand_id' => json_decode(Auth::guard('account')->user()->properties)->brand_id,
            'qty' => $request->qty,
            'unit' => strtolower($request->unit),
            'price' => $request->price
        ]);

        if ($request->status == 'served') {
            $order->served = date('Y-m-d');
        } else if ($request->status == 'cancelled') {
            $order->cancelled = date('Y-m-d');
        }

        $order->save();

        return back()->with('status', 'Successfully updated!');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->forceDelete();
    }
}
