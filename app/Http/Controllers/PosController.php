<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\GiftCard;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PosController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::get();
        return view('admin.pos.index', [

            'products' => $products,
            'title' => 'Pos'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function categoryProducts($id)
    {
        $categoryProducts = DB::table('products')->where('category_id', $id)->get();

        return response()->json($categoryProducts);
    }

    

    public function todaySell()
    {
        $todaySell = DB::table('orders')->where('order_date', date('d/m/Y'))->sum('total');
        return response()->json($todaySell);
    }

    public function todayIncome()
    {
        $todayIncome = DB::table('orders')->where('order_date', date('d/m/Y'))->sum('pay');
        return response()->json($todayIncome);
    }

    public function todayDue()
    {
        $todayDue = DB::table('orders')->where('order_date', date('d/m/Y'))->sum('due');
        return response()->json($todayDue);
    }

    public function expenses()
    {
        $expenses = DB::table('expenses')->where('expense_date', date('Y-m-d'))->sum('amount');
        return response()->json($expenses);
    }

    public function stockOut()
    {
        $stockOut = DB::table('products')->where('product_quantity', '<', 1)->get();
        return response()->json($stockOut);
    }
}
