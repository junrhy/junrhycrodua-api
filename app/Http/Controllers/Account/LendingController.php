<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LendingController extends Controller
{
    public function index() {
        return view('account.lending.index');
    }
}
