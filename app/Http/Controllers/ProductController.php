<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::paginate(10);
        $categories=Category::all();
        return view('pages.product')->with([
            'products'=>$products,
            'categories'=>$categories,

        ]);
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
        $request->validate([
            'product_name'=>'required',
            'category_id'=>'required',
        ]);

        Product::create ([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
        ]);

        return redirect()->back()->with('success','Product berhasil ditambahkan');
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
        $request->validate([
            'product_name'=>'required',
            'category_id'=>'required',
        ]);

        Product::find($id)->update ([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
        ]);

        return redirect()->back()->with('success','Product berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Product::find($id)->delete();
        return redirect()->back()->with('success','Product berhasil di hapus');
    }
}
