<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, $id)
    {
        return 'user page from index' . ' ' . $id;
    }
}