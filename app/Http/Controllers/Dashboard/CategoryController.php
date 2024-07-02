<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCategory = CategoryProduct::all();

        return view('pages.categories.index', compact(['allCategory']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $request->validate([
            'name'      => 'required|string',
            'slug'      => 'required|string'
        ]);

        CategoryProduct::create([
            'name'      => $category['name'],
            'slug'      => $category['slug']
        ]);

        return redirect()->route('category.index');
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
        $category = CategoryProduct::find($id);

        return view('pages.categories.edit', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attrs = $request->validate([
            'name'      => 'string',
            'slug'      => 'string'
        ]);

        $category = CategoryProduct::find($id);

        $category->update([
            'name'      => $attrs['name'],
            'slug'      => $attrs['slug']
        ]);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CategoryProduct::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori produk berhasil dihapus.');
    }
}
