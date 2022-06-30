<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        return $this->viewData($schedules);
    }
 
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);

        return $this->viewData($schedule);
    }

    public function store(Request $request)
    {
        $schedule = Schedule::create($request->all());

        return $this->viewData($schedule);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());

        return $this->viewData($schedule);
    }

    public function destroy(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return 204;
    }
}
