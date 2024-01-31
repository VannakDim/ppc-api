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

    public function income()
    {
        return view('web.add_income');
    }

    public function expense()
    {
        return view('web.add_expense');
    }

    

}
