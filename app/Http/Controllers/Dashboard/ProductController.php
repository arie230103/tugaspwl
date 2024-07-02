<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProduct = Product::selectRaw('category_products.name as category, products.*')
        ->join('category_products', 'products.category_id', '=', 'category_products.id')
        ->orderBy('id', 'desc')
        ->get();

        return view('pages.products.index', compact(['allProduct']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = CategoryProduct::all();

        return view('pages.products.create', compact(['category']));
    }

    /**
     * Private function for parsing string to boolean.
     */
    private function parseBoolean($str) {
        $lowerStr = strtolower($str);

        if ($lowerStr === 'true') {
            return true;
        } elseif ($lowerStr === 'false') {
            return false;
        } else {
            return null;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/products', $filename);
        } else {
            $image_path = null;
        }

        Product::create([
            'category_id'           => $request->category_id,
            'name'                  => $request->name,
            'price'                 => floatval($request->price),
            'stock'                 => $request->stock,
            'is_discount'           => $this->parseBoolean($request->is_discount),
            'discount'              => floatval($request->discount),
            'description'           => $request->description,
            'rating'                => 0,
            'image_path'            => $image_path
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil disimpan!');
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
        $product = Product::find($id);
        $category = CategoryProduct::all();

        return view('pages.products.edit', compact(['product', 'category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());

            if ($product->image_path != null) unlink($product->image_path);
            $image_path = $file->move('storage/products', $filename);
        } else {
            $image_path = $product->image_path;
        }

        $product->update([
            'category_id'           => $request->category_id,
            'name'                  => $request->name,
            'price'                 => floatval($request->price),
            'stock'                 => $request->stock,
            'is_discount'           => $this->parseBoolean($request->is_discount),
            'discount'              => floatval($request->discount),
            'description'           => $request->description,
            'rating'                => 0,
            'image_path'            => $image_path
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product->image_path != null) unlink($product->image_path);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus!');
    }
}
