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
}
