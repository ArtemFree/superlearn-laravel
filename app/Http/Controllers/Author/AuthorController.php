<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request, $id)
    {
        $author = Author::find($id);
        if ($author) {
            return view('author.page', array('author' => $author));
        } else {
            return view('author.404');
        }
    }

    public function authors(Request $request)
    {
        $authors = Author::all();

        return view('author.authors', array('authors' => $authors));
    }
}
