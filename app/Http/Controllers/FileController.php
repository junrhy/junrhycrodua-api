<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\File;

class FileController extends Controller
{
    public function index()
    {
        $files = File::paginate(10);

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

    public function destroy($id)
    {
        $ids = explode(",",$id);
        File::whereIn('id', $ids)->delete();

        return 204;
    }
}
