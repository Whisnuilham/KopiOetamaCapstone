<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $products=Product::where('product_name','like','%'.$request -> search.'%')
        ->when ($request -> has('category_id'), function ($query) use ($request){
            if ($request->category_id != '' && $request->category_id != 'all') {
                $query -> where ('category_id', $request -> category_id);
            }

        } )

        ->latest()
        ->paginate(10)
        ->withQueryString();
        $categories=Category::all();
        $ingredients=Ingredient::all();
        $ingredientsCategory=Ingredient::pluck('category')->unique();
        // dd($products->first()->ingredients);
        return view('pages.product')->with([
            'products'=>$products,
            'categories'=>$categories,
            'ingredients'=>$ingredients,
            'ingredientsCategory'=>$ingredientsCategory,

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

        $ingredients_qty=$request->qty_ingredients;
        $filterdata=array_filter($ingredients_qty, function($value) {
            return $value !== null;
        });

        $combinedArray = array_combine($request->ingredients, $filterdata);

        // Membentuk array asosiatif dengan kunci sebagai kunci dan 'quantity' sebagai nilai
        $results = [];
        foreach ($combinedArray as $key => $value) {
            $results[$key] = ['quantity' => $value];
        }

        // dd($request->ingredients,$filterdata,$combinedArray, $results, $ingredients_qty);

        $product=Product::create ([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
        ]);

        $product->ingredients()->sync($results);

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
        // dd($request);
        $request->validate([
            'product_name'=>'required',
            'category_id'=>'required',
        ]);

        $ingredients_qty=$request->qty_ingredients;
        $filterdata=array_filter($ingredients_qty, function($value) {
            return $value !== null;
        });

        $combinedArray = array_combine($request->ingredients, $filterdata);

        // Membentuk array asosiatif dengan kunci sebagai kunci dan 'quantity' sebagai nilai
        $results = [];
        foreach ($combinedArray as $key => $value) {
            $results[$key] = ['quantity' => $value];
        }
        // dd($request->ingredients, $filterdata, $results);
        $product=Product::find($id);
        $product->update ([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
        ]);

        $product->ingredients()->sync($results);

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
