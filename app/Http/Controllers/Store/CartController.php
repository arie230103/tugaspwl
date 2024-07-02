<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::selectRaw('products.*, carts.*, carts.id as cart_id, products.id as product_id')->join("products", "products.id", "=", "carts.product_id")->get();

        return view('store.pages.carts.index', compact(['carts']));
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
        $cart = Cart::find($id);

        if ($cart) {
            $cart->delete();
        }

        return redirect()->back();
    }

    public function addCart(string $id)
    {
        $cart = Cart::where("user_id", Auth::user()->id)->where('product_id', $id)->get();

        if ($cart->count() > 0) {
            return redirect()->back();
        }

        Cart::create([
            'product_id'        => $id,
            'user_id'           => Auth::user()->id
        ]);

        return redirect()->back();
    }
}
