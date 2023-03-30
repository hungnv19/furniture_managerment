<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

class CartController extends BaseController
{
	public function index()
    {

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      
    }

    public function addToCart($id)
	{
		$exist_product = DB::table('pos')->where('product_id', $id)->first();

		if ($exist_product) {

			DB::table('pos')->where('product_id', $id)->increment('product_quantity');

			$product = DB::table('pos')->where('product_id', $id)->first();
			$sub_total = $product->product_price * $product->product_quantity;
			DB::table('pos')->where('product_id', $id)->update(['sub_total' => $sub_total]);

		} else {
			$product = DB::table('products')->where('id', $id)->first();

			$data = [];
			$data['product_id'] = $id;
			$data['product_name'] = $product->product_name;
			$data['product_quantity'] = 1;
			$data['product_price'] = $product->selling_price;;
			$data['sub_total'] = $product->selling_price;

			DB::table('pos')->insert($data);
		}
	}

	public function cartProducts()
	{
		$products = DB::table('pos')
			->join('products', 'products.id', '=', 'pos.product_id')
			->select([
				'pos.*'
			])
			->get();
		return response()->json($products);
	}

	public function cartDelete($id)
	{
		DB::table('pos')->where('id', $id)->delete();
		return response('Done');
	}

	public function increment($id)
	{
		$quantity = DB::table('pos')->where('id', $id)->increment('product_quantity');

		$product = DB::table('pos')->where('id', $id)->first();
		$sub_total = $product->product_price * $product->product_quantity;
		DB::table('pos')->where('id', $id)->update(['sub_total' => $sub_total]);
	}

	public function decrement($id)
	{
		$quantity = DB::table('pos')->where('id', $id)->decrement('product_quantity');

		$product = DB::table('pos')->where('id', $id)->first();
		$sub_total = $product->product_price * $product->product_quantity;
		DB::table('pos')->where('id', $id)->update(['sub_total' => $sub_total]);
	}

	public function vat()
	{
		$vat = DB::table('extra')->first();
		return response()->json($vat);
	}
}
