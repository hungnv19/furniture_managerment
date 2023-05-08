<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Customer;
use App\Models\GiftCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends BaseController
{
	public function index()
	{
		$pos = DB::table('pos')
			->join('products', 'products.id', '=', 'pos.product_id')
			->select([
				'pos.*'
			])->get();

		$extra = DB::table('extra')->first();

		
		return view('client.cart.index', [
			'title' => 'Cart',
			'pos' => $pos,
			
			'extra' => $extra,
		]);
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
		DB::table('pos')->where('id', $id)->delete();
		return redirect()->route('cart.index');
	}
	public function cartDelete($id)
	{
		DB::table('pos')->where('id', $id)->delete();
		return redirect()->route('cart.index');
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
		return redirect()->route('cart.index');
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
	public function cartProducts()
	{
		$products = DB::table('pos')
			->join('products', 'products.id', '=', 'pos.product_id')
			->select([
				'pos.*'
			])
			->get();
		// dd($products);
		return response()->json($products);
	}
	public function order(Request $request)
    {
        
        // try {
            DB::beginTransaction();
            // if ($request->gift_card_id) {
            //     $giftCard = GiftCard::find($request->gift_card_id);
            //     if (!$giftCard) {
            //         return response()->json(
            //             [
            //                 'result' => false
            //             ],
            //             200
            //         );
            //     }
            //     $giftBalance = $giftCard->balance;
            //     $giftCard->balance = $giftBalance >= $request->total ? $giftBalance - $request->total : 0;
            //     $giftCard->save();
            // }
            $data = [];	
            $data['user_id'] = Auth::user()->id;
            $data['qty'] = $request->qty;
            $data['sub_total'] = $request->sub_total;
            $data['vat'] = $request->vat;
            $data['total'] = $request->total;
            $data['pay'] = $request->pay;
            $data['due'] = $request->due;
            $data['payBy'] = $request->payBy;
          
            $data['order_date'] = date('d/m/Y');
            $data['order_month'] = date('F');
            $data['order_year'] = date('Y');
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $order_id = DB::table('orders')->insertGetId($data);

            $cartContents = DB::table('pos')->get();
			// dd($cartContents);
            $cartData = [];
            foreach ($cartContents as $content) {
                $cartData['order_id'] = $order_id;
                $cartData['product_id'] = $content->product_id;
                $cartData['product_quantity'] = $content->product_quantity;
                $cartData['product_price'] = $content->product_price;
                $cartData['sub_total'] = $content->sub_total;
                $cartData['created_at'] = Carbon::now();
                $cartData['updated_at'] = Carbon::now();
                DB::table('order_details')->insert($cartData);

                DB::table('products')
                    ->where('id', $content->product_id)
                    ->update(['product_quantity' => DB::raw('product_quantity - ' . $content->product_quantity)]);
            }

            DB::table('pos')->delete();
            DB::commit();
           
            return redirect()->route('order.index');
           
        // } catch (\Exception $ex) {
        //     DB::rollBack();
			
        //     return redirect()->route('order.index');
        // }
    }
}
