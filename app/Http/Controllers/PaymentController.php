<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::paginate(10);

        return $this->viewData($payments);
    }
 
    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return $this->viewData($payment);
    }

    public function store(Request $request)
    {
        $payment = Payment::create($request->all());

        return $this->viewData($payment);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return $this->viewData($payment);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Payment::whereIn('id', $ids)->delete();

        return 204;
    }
}
