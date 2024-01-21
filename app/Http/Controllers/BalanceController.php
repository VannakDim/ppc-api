<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Income;
use App\Models\Expense;
use App\Models\ExchangeRate;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function totalBalance()
    {
        $exchange_rate = ExchangeRate::where('currency','usd-riel')->first();
        $user = Auth::user();
        if($user != null){
        $income_usd = Income::all()->sum('usd');
        $income_riel = Income::all()->sum('riel');
        $expense_usd = Expense::all()->sum('usd');
        $expense_riel = Expense::all()->sum('riel');
            return response()->json([
                'total-income-usd'=>$income_usd ,
                'total-income-riel'=>$income_riel ,
                'total-income-as-usd'=>($income_riel/$exchange_rate->rate) + $income_usd,
                'total-expense-usd'=>$expense_usd ,
                'total-expense-riel'=>$expense_riel ,
                'total-expense-as-usd'=>($expense_riel/$exchange_rate->rate) + $expense_usd,
                'Final-Balance-as-usd'=>(($income_riel/$exchange_rate->rate) + $income_usd) - (($expense_riel/$exchange_rate->rate) + $expense_usd)
            ],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
