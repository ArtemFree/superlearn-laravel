<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    public function index(Request $request, $id)
    {
        if ($request->user()->id == $id && Auth::check()) {
            return Redirect::to('/profile');
        }

        $user = User::find($id);

        if ($user) {
            return view('user.page', array('user' => $user));
        } else {
            return 'not found';
        }
    }

    public function profile(Request $request)
    {
        return view('user.profile', array('user' => $request->user()));
    }
}
