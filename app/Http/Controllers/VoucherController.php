<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::paginate(10);

        return $this->viewData($vouchers);
    }
 
    public function show($id)
    {
        $voucher = Voucher::findOrFail($id);

        return $this->viewData($voucher);
    }

    public function store(Request $request)
    {
        $voucher = Voucher::create($request->all());

        return $this->viewData($voucher);
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->update($request->all());

        return $this->viewData($voucher);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Voucher::whereIn('id', $ids)->delete();

        return 204;
    }
}
