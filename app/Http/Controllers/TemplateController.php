<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Template;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();

        return $this->viewData($templates);
    }
 
    public function show($id)
    {
        $template = Template::findOrFail($id);

        return $this->viewData($template);
    }

    public function store(Request $request)
    {
        $template = Template::create($request->all());

        return $this->viewData($template);
    }

    public function update(Request $request, $id)
    {
        $template = Template::findOrFail($id);
        $template->update($request->all());

        return $this->viewData($template);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Template::whereIn('id', $ids)->delete();

        return 204;
    }
}
