<?php

namespace App\Http\Controllers;

use App\Models\IngredientStock;
use Illuminate\Http\Request;

class IngredientStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $ingredient_stocks=IngredientStock::paginate(10);
        return view('pages.ingredient_stock')->with([
            'ingredient_stocks'=>$ingredient_stocks
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
            'ingredient_name'=>'required',
            'category'=>'required',
            'in_stock'=>'required',
            'date'=>'required',
        ]);

        IngredientStock::create ([
            'ingredient_name'=>$request->ingredient_name,
            'category'=>$request->category,
            'in_stock'=>$request->in_stock,
            'date'=>$request->date,
        ]);

        return redirect()->back()->with('success','Ingredient berhasil ditambahkan');
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
            'ingredient_name'=>'required',
            'category'=>'required',
            'in_stock'=>'required',
            'date'=>'required',
        ]);

        IngredientStock::find($id)->update ([
            'ingredient_name'=>$request->ingredient_name,
            'category'=>$request->category,
            'in_stock'=>$request->in_stock,
            'date'=>$request->date,
        ]);

        return redirect()->back()->with('success','Ingredient berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        IngredientStock::find($id)->delete();
        return redirect()->back()->with('success','Ingredient berhasil di hapus');
    }
}
