<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        return $this->viewData($bookings);
    }
 
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return $this->viewData($booking);
    }

    public function store(Request $request)
    {
        $booking = Booking::create($request->all());

        return $this->viewData($booking);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return $this->viewData($booking);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Booking::whereIn('id', $ids)->delete();

        return 204;
    }
}
