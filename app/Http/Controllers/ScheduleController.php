<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::paginate(10);

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

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Schedule::whereIn('id', $ids)->delete();

        return 204;
    }
}
