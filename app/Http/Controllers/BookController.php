<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return $this->viewData($books);
    }
 
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return $this->viewData($book);
    }

    public function store(Request $request)
    {
        $book = Book::create($request->all());

        return $this->viewData($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return $this->viewData($book);
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return 204;
    }
}
