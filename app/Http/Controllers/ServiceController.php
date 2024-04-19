<?php

namespace App\Http\Controllers;

use App\Models\Service;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(10);

        return $this->viewData($services);
    }
 
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return $this->viewData($service);
    }

    public function store(Request $request)
    {
        $service = Service::create($request->all());

        return $this->viewData($service);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());

        return $this->viewData($service);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Service::whereIn('id', $ids)->delete();

        return 204;
    }
}
