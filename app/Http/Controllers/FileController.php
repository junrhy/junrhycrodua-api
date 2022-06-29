<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\File;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();

        return $this->viewData($files);
    }
 
    public function show($id)
    {
        $file = File::findOrFail($id);

        return $this->viewData($file);
    }

    public function store(Request $request)
    {
        $file = File::create($request->all());

        return $this->viewData($file);
    }

    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);
        $file->update($request->all());

        return $this->viewData($file);
    }

    public function destroy(Request $request, $id)
    {
        $file = File::findOrFail($id);
        $file->delete();

        return 204;
    }
}
