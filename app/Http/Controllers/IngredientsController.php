<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $ingredients=Ingredient::paginate(10);
        return view('pages.ingredients')->with([
            'ingredients'=>$ingredients
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
            'unit'=>'required',

        ]);

        Ingredient::create ([
            'ingredient_name'=>$request->ingredient_name,
            'category'=>$request->category,
            'unit'=>$request->unit,

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
            'unit'=>'required',

        ]);

        Ingredient::find($id)->update ([
            'ingredient_name'=>$request->ingredient_name,
            'category'=>$request->category,
            'unit'=>$request->unit,

        ]);

        return redirect()->back()->with('success','Ingredient berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Ingredient::find($id)->delete();
        return redirect()->back()->with('success','Ingredient berhasil di hapus');
    }
}

