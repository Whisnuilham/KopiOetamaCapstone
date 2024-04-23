<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientStock;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class IngredientStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $ingredients_stocks=IngredientStock::
        when($request -> has('search'), function ($query) use($request){
            if ($request->search != '') {
            $query -> whereHas ('ingredient', function($query2) use($request){
                $query2 -> where('ingredient_name','like','%'.$request -> search.'%');
            });
        }
        })

        ->when ($request -> has('category'), function ($query) use ($request){
            if ($request->category != '' && $request->category != 'all') {
            $query -> whereHas ('ingredient', function($query2) use($request){
                $query2 -> where ('category', $request -> category);
            });
        }
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();
        $ingredients=Ingredient::all();
        return view('pages.ingredient_stock')->with([
            'ingredient_stocks'=>$ingredients_stocks,
            'ingredients'=>$ingredients,
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
            'ingredient_id'=>'required',
            'in_stock'=>'required|numeric|min:1',
            'date'=>'required|date',
            'expired_date'=>'date'
        ]);

        $ingredient_stock = IngredientStock::create ([
            'ingredient_id'=>$request->ingredient_id,
            'in_stock'=>$request->in_stock,
            'date'=>$request->date,
            'expired_date' => $request->expired_date
        ]);

        ActivityLog::create([
            'action' => 'Created',
            'table_name' => 'Ingredients Stock',
            'user_id' => auth()->user()->id,
            'item_id' => $ingredient_stock->id,
            'item_name'=> $ingredient_stock->product_name,
            'item_category'=> $ingredient_stock->category_id,
            'item_description' => $ingredient_stock->description,
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
            'ingredient_id'=>'required',
            'in_stock'=>'required',
            'date'=>'required',
            'expired_date'=>'date'
        ]);

        IngredientStock::find($id)->update ([
            'ingredient_id'=>$request->ingredient_id,
            'in_stock'=>$request->in_stock,
            'date'=>$request->date,
            'expired_date' => $request->expired_date
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
