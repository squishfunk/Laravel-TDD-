<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

        return Book::create($data);
    }

    public function update(Book $book, Request $request){
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
        $book->update($data);
    }
}
