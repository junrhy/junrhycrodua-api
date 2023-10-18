<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);

        return $this->viewData($projects);
    }
 
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return $this->viewData($project);
    }

    public function store(Request $request)
    {
        $project = Project::create($request->all());

        return $this->viewData($project);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return $this->viewData($project);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Project::whereIn('id', $ids)->delete();

        return 204;
    }
}
