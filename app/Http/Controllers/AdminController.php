<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    //Register user
    public function index()
    {
        return view('admin.dashboard');
    }

    

}
