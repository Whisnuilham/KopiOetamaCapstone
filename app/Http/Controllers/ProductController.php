<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Get authenticated user's notifications
        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        return view('pages.product')->with([
            'products'=>$products,
            'categories'=>$categories,
            'ingredients'=>$ingredients,
            'ingredientsCategory'=>$ingredientsCategory,
            'notifications'=>$notifications

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
            'ingredients' =>'required',
            'ingredients.*' =>'required',
            'qty_ingredients' => 'required',
        ]);

        $ingredients_qty=$request->qty_ingredients;
        $filterdata = array_map(function($value) {
            return $value !== null ? $value : 0;
        }, $ingredients_qty);

        $filteredQuantities = [];
        foreach ($request->ingredients as $ingredientId) {
            // Check if the ingredient ID exists as a key in the quantities array
            if (isset($filterdata[$ingredientId])) {
                // Add the quantity corresponding to the ingredient ID
                $filteredQuantities[$ingredientId] = $filterdata[$ingredientId];
            }
        }
        //dd($request->ingredients,$filterdata,$filteredQuantities);
        $combinedArray = array_combine($request->ingredients, $filteredQuantities);

        // Membentuk array asosiatif dengan kunci sebagai kunci dan 'quantity' sebagai nilai
        $results = [];
        foreach ($combinedArray as $key => $value) {
            $results[$key] = ['quantity' => $value];
        }


        $product=Product::create ([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
        ]);

        $product->ingredients()->sync($results);

        ActivityLog::create([
            'action' => 'Created',
            'table_name' => 'Products',
            'user_id' => auth()->user()->id,
            'item_id' => $product->id,
            'item_name'=> $product->product_name,
            'item_category'=> $product->category_id,
            'item_description' => $product->description,
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
        // dd($request);
        /* $request->validate([
            'product_name'=>'required',
            'category_id'=>'required',
        ]);

        $ingredients_qty=$request->qty_ingredients;
        
        $filterdata=array_filter($ingredients_qty, function($value) {
            return $value !== null;
        });

        $combinedArray = array_combine($request->ingredients, $filterdata); */

        $request->validate([
            'product_name'=>'required',
            'category_id'=>'required',
            'ingredients' =>'required',
            'qty_ingredients' => 'required',
        ]);

        $ingredients_qty=$request->qty_ingredients;
        $filterdata = array_map(function($value) {
            return $value !== null ? $value : 0;
        }, $ingredients_qty);

        $filteredQuantities = [];
        foreach ($request->ingredients as $ingredientId) {
            // Check if the ingredient ID exists as a key in the quantities array
            if (isset($filterdata[$ingredientId])) {
                // Add the quantity corresponding to the ingredient ID
                $filteredQuantities[$ingredientId] = $filterdata[$ingredientId];
            }
        }
        // dd($request->ingredients,$request->qty_ingredients, $filterdata,$filteredQuantities);
        $combinedArray = array_combine($request->ingredients, $filteredQuantities);

        // dd($combinedArray);
        // Membentuk array asosiatif dengan kunci sebagai kunci dan 'quantity' sebagai nilai
        $results = [];
        foreach ($combinedArray as $key => $value) {
            $results[$key] = ['quantity' => $value];
        }
        // dd($request->ingredients, $filterdata, $results);
        $product=Product::find($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Get the original attributes before updating
        $originalAttributes = $product->getOriginal();

        $product->update ([
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
        ]);

        $originalIngredients = $product->ingredients;

        $product->ingredients()->sync($results);
        $newIngredients = $product->ingredients()->get();
        
        // Initialize an empty string to store the changed attributes with old and new values
        $changedAttributesString = '';
        
        // Iterate over the changed attributes
        foreach ($product->getChanges() as $attribute => $newValue) {
            // Get the previous value of the attribute
            $oldValue = $originalAttributes[$attribute];
            
            // Concatenate the attribute name, old value, and new value to the string
            $changedAttributesString .= "$attribute: $oldValue => $newValue, ";
        }
        
        foreach ($newIngredients as $newValue){
            // dd($newvalue);
             $oldValue = $originalIngredients->where('id', $newValue->id)->first();
             $oldQty = $oldValue?->pivot?->quantity ?? '0';
             $newQty = $newValue->pivot->quantity;
             
             $changedAttributesString .= "$newValue->ingredient_name: $oldQty => $newQty, ";
        }
        
        // Remove the trailing comma and space
        $changedAttributesString = rtrim($changedAttributesString, ', ');

        ActivityLog::create([
            'action' => 'Updated',
            'table_name' => 'Products',
            'user_id' => auth()->user()->id,
            'item_id' => $product->id,
            'item_name'=> $product->product_name,
            'item_category'=> $product->category_id,
            'item_description' => $product->description,
            'changed_attributes' => $changedAttributesString
        ]);

        return redirect()->back()->with('success','Product berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);

        // Check if category exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Capture the data before deleting the product
        $itemId = $product->id;
        $itemName = $product->name;
        $itemCategory = $product->category_id;
        $itemDescription = $product->description;

        
        $product->delete();

        ActivityLog::create([
            'action' => 'Deleted',
            'table_name' => 'Products',
            'user_id' => auth()->user()->id,
            'item_id' => $itemId,
            'item_name'=> $itemName,
            'item_category'=> $itemCategory,
            'item_description' => $itemDescription
        ]);

        return redirect()->back()->with('success','Product berhasil di hapus');
    }
}