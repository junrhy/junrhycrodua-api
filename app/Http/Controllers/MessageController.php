<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        return $this->viewData($messages);
    }
 
    public function show($id)
    {
        $message = Message::findOrFail($id);

        return $this->viewData($message);
    }

    public function store(Request $request)
    {
        $message = Message::create($request->all());

        return $this->viewData($message);
    }

    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update($request->all());

        return $this->viewData($message);
    }

    public function destroy(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return 204;
    }
}
