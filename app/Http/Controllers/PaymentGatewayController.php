<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PaymentGateway;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $payments = PaymentGateway::paginate(10);

        return $this->viewData($payments);
    }
 
    public function show($id)
    {
        $payment = PaymentGateway::findOrFail($id);

        return $this->viewData($payment);
    }

    public function store(Request $request)
    {
        $payment = PaymentGateway::create($request->all());

        return $this->viewData($payment);
    }

    public function update(Request $request, $id)
    {
        $payment = PaymentGateway::findOrFail($id);
        $payment->update($request->all());

        return $this->viewData($payment);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        PaymentGateway::whereIn('id', $ids)->delete();

        return 204;
    }
}
