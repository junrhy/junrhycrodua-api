<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return $this->viewData($contacts);
    }
 
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return $this->viewData($contact);
    }

    public function store(Request $request)
    {
        $contact = Contact::create($request->all());

        return $this->viewData($contact);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return $this->viewData($contact);
    }

    public function destroy($id)
    {
        $ids = explode(",",$id);
        Contact::whereIn('id', $ids)->delete();

        return 204;
    }
}
