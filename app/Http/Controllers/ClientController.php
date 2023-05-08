<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public User $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $products = Product::get();
        return view('client.layouts.main', [
            'products' => $products,
        ]);
    }
    public function shop()
    {
        $products = Product::select('products.*')
            ->orderBy('product_name')->with('categories')->paginate(12);
        $categories = Category::select('id', 'category_name')->get();
        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
    public function searchProduct(Request $requests)
    {
        $products= Product::where('product_name', 'like', '%' . $requests->name . '%')->paginate(12);
        $categories = Category::select('id', 'category_name')->get();

        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
    public function categoryProducts($id)
    {
        $products = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*')
            ->where('products.category_id', '=', $id)
            ->paginate(12);
        $categories = Category::select('id', 'category_name')->get();


        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
    public function profile()
    {
        $user = Auth::user();
        // dd($user);`
        return view('client.profile.index', [
            'user' => $user,
        ]);
        
    }
    public function updateProfile(Request $request)
    {

        $user =  $this->user->where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        $this->setFlash(__('Cập nhật  thành công'));
        return redirect()->back();
    }
}
