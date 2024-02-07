<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;

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

    public function detailIncome(){
        $income = Income::orderBy('created_at','desc')->paginate(10);
        return view ('web.income', ['income'=> $income]);
    }

    public function detailExpense(){
        $expense = Expense::orderBy('created_at','desc')->paginate(10);
        return view ('web.expense', ['expense'=> $expense]);
    }

}
