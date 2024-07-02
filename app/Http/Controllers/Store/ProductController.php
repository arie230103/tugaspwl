<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy("id", "desc")->get();

        return view("store.pages.products.all", compact(["products"]));
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
        $product = Product::find($id);
        $reviews = Review::selectRaw("*")->join('users', 'users.id', '=', 'reviews.user_id')->get();

        return view('store.pages.products.detail', compact(['product', 'reviews']));
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

    public function getBySlug(string $slug)
    {
        $category = CategoryProduct::where('slug', '=', $slug)->first();

        $products = Product::where('category_id', '=', $category->id)->get();

        return view('store.pages.products.allBySlug', compact(['products']));
    }
}
