<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Income;
use App\Models\Expense;
use App\Models\ExchangeRate;

class WebController extends Controller
{
    public function dashboard()
    {   $user = Auth::user();
        $exchange_rate = ExchangeRate::where('currency','usd-riel')->first();
        if($user != null){
            $fromDate="2024-01-15";
            $toDate=Carbon::now();
            
            $income_usd = Income::whereBetween('created_at',[$fromDate,Carbon::parse($toDate)->endOfDay()])->sum( 'usd');
            $income_riel = Income::whereBetween('created_at',[$fromDate,Carbon::parse($toDate)->endOfDay()])->sum( 'riel');
            
            $expense_usd = Expense::whereBetween('created_at',[$fromDate,Carbon::parse($toDate)->endOfDay()])->sum('usd');
            $expense_riel = Expense::whereBetween('created_at',[$fromDate,Carbon::parse($toDate)->endOfDay()])->sum('riel');
            
            $balance_usd = $income_usd - $expense_usd;
            $balance_riel = $income_riel - $expense_riel;

            return view('web.dashboard',compact('income_usd','income_riel','expense_usd','expense_riel','balance_usd','balance_riel'));
        }
    }
}
