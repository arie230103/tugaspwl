<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::selectRaw("products.*")
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        return view('store.pages.index', compact(['products']));
    }
}
