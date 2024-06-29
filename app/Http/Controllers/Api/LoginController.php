<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Login;

class LoginController extends Controller
{
    public function index()
    {
        $logins = Login::all();

        return $this->viewData($logins);
    }
 
    public function show($id)
    {
        $login = Login::findOrFail($id);

        return $this->viewData($login);
    }

    public function store(Request $request)
    {
        $login = Login::create($request->all());

        return $this->viewData($login);
    }

    public function update(Request $request, $id)
    {
        $login = Login::findOrFail($id);
        $login->update($request->all());

        return $this->viewData($login);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Login::whereIn('id', $ids)->delete();

        return 204;
    }
}
