<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Income;
use App\Models\ExchangeRate;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'incomes' => Income::orderBy('created_at', 'desc')->with('user:id,name,image')->get()
        ], 200);
    }

    //Display total income
    public function totalIncome(){
        $user = Auth::user();
        $exchange_rate = ExchangeRate::where('currency','usd-riel')->first();
        if($user != null){
            $fromDate="2024-01-15";
            $toDate=Carbon::now();
            $income_usd = Income::whereBetween('created_at',[$fromDate,Carbon::parse($toDate)->endOfDay()])->sum( 'usd');
            $income_riel = Income::whereBetween('created_at',[$fromDate,Carbon::parse($toDate)->endOfDay()])->sum('riel');
            return response()->json([
                'title'=>'Income from 01-JAN-2024 until now',
                'total-usd-income'=>$income_usd,
                'total-riel-income'=>$income_riel,
                'total-income-exchange-to-usd'=>$income_usd + ($income_riel/$exchange_rate->rate)
            ], 200);
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
        $data = $request->all();
        $user = Auth::user();
        if($user != null){
            $data['user_id'] = $user->id;
            $income = Income::create($data);
            return response()->json(['income'=>$income],200);
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
