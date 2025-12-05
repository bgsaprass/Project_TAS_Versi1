<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the users for admin.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.user', compact('users'));
    }
}
