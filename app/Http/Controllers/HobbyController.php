<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hobby;

class HobbyController extends Controller
{
    public function index()
    {
        $hobbies = Hobby::paginate(10);

        return $this->viewData($hobbies);
    }
 
    public function show($id)
    {
        $hobby = Hobby::findOrFail($id);

        return $this->viewData($hobby);
    }

    public function store(Request $request)
    {
        $hobby = Hobby::create($request->all());

        return $this->viewData($hobby);
    }

    public function update(Request $request, $id)
    {
        $hobby = Hobby::findOrFail($id);
        $hobby->update($request->all());

        return $this->viewData($hobby);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Hobby::whereIn('id', $ids)->delete();

        return 204;
    }
}
