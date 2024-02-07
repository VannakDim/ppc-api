<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\ExchangeRate;
use Illuminate\Support\Carbon;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'expenses' => Expense::orderBy('created_at', 'desc')->with('user:id,name,image')->get()
        ], 200);
    }

    //Display total expense
    public function totalExpense(){
        $user = Auth::user();
        $exchange_rate = ExchangeRate::where('currency','usd-riel')->first();
        if($user != null){
            $fromDate="2024-01-15";
            $toDate="2024-01-16";
        $expense_usd = Expense::whereBetween('created_at',[$fromDate,Carbon::parse($toDate)->endOfDay()])->sum( 'usd');
        $expense_riel = Expense::whereBetween('created_at',[$fromDate,Carbon::parse($toDate)->endOfDay()])->sum('riel');
            return response()->json(['total-expense-as-usd'=>$expense_usd + ($expense_riel/$exchange_rate->rate)], 200);
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
        //validate fields
        $attrs = $request->validate([
            'title' => 'required|string',
            'usd' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'riel' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'required'
        ]);
        
        $data = $request->all();
        $user = Auth::user();
        if($user != null){
            $data['user_id'] = $user->id;
            $expense = Expense::create($data);
            if ($request->expectsJson()) {
                return response()->json(['Expense'=>$expense],200);
            }else{
                return back()->with('message','Expense added Successful');
            }
        }
        return response()->json(['error'=>'Unauthorized']);
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
