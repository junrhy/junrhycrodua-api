<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();

        return $this->viewData($subscriptions);
    }
 
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);

        return $this->viewData($subscription);
    }

    public function store(Request $request)
    {
        $subscription = Subscription::create($request->all());

        return $this->viewData($subscription);
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($request->all());

        return $this->viewData($subscription);
    }

    public function destroy(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return 204;
    }
}
