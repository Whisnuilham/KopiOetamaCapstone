<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientStock;
use App\Models\ActivityLog;
use App\Models\User;
use App\Notifications\IngredientsExpiredNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Carbon\Carbon;


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

        // Get authenticated user's notifications
        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        return view('pages.ingredient_stock')->with([
            'ingredient_stocks'=>$ingredients_stocks,
            'ingredients'=>$ingredients,
            'notifications' => $notifications
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
            'expired_date'=>'date|nullable'
        ]);

        $ingredient = Ingredient::where('id', $request->ingredient_id)->first();

        // Make sure $ingredient is not null before accessing its properties
        if ($ingredient) {
            $ingredient_stock = IngredientStock::create([
                'ingredient_id' => $request->ingredient_id,
                'in_stock' => $request->in_stock,
                'date' => $request->date,
                'expired_date' => $request->expired_date
            ]);

            ActivityLog::create([
                'action' => 'Created',
                'table_name' => 'Ingredients Stock',
                'user_id' => auth()->user()->id,
                'item_id' => $ingredient_stock->id,
                'item_name' => $ingredient->ingredient_name,
                'item_in_stock' => $ingredient_stock->in_stock,
                'item_date' => $ingredient_stock->date,
            ]);
        } else {
            // Handle case where ingredient is not found
            $ingredient_stock = IngredientStock::create([
                'ingredient_id' => $request->ingredient_id,
                'in_stock' => $request->in_stock,
                'date' => $request->date,
                'expired_date' => $request->expired_date
            ]);

            ActivityLog::create([
                'action' => 'Created',
                'table_name' => 'Ingredients Stock',
                'user_id' => auth()->user()->id,
                'item_id' => $ingredient_stock->id,
                'item_name' => 'N/A',
                'item_in_stock' => $ingredient_stock->in_stock,
                'item_date' => $ingredient_stock->date,
            ]);
        }

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

        $ingredient_stock = IngredientStock::find($id);
        $ingredient = Ingredient::find($ingredient_stock->ingredient_id);

        // If the ingredient stock doesn't exist, return with an error
        if (!$ingredient_stock) {
            return redirect()->back()->with('error', 'Ingredient not found');
        }

        // Get the original attributes before updating
        $originalAttributes = $ingredient_stock->getOriginal();

        $ingredient_stock->update ([
            'ingredient_id'=>$request->ingredient_id,
            'in_stock'=>$request->in_stock,
            'date'=>$request->date,
            'expired_date' => $request->expired_date
        ]);

        // Initialize an empty string to store the changed attributes with old and new values
        $changedAttributesString = '';

        // Iterate over the changed attributes
        foreach ($ingredient_stock->getChanges() as $attribute => $newValue) {
            // Get the previous value of the attribute
            $oldValue = $originalAttributes[$attribute];

            // Concatenate the attribute name, old value, and new value to the string
            $changedAttributesString .= "$attribute: $oldValue => $newValue, ";
        }
        
        // Remove the trailing comma and space
        $changedAttributesString = rtrim($changedAttributesString, ', ');

        // Log the activity
        ActivityLog::create([
            'action' => 'Updated',
            'table_name' => 'Ingredients Stock',
            'user_id' => auth()->user()->id,
            'item_id' => $ingredient_stock->id,
            'item_in_stock' => $ingredient_stock->in_stock,
            'item_date' => $ingredient_stock->date,
            'item_name' => $ingredient->ingredient_name,
            'changed_attributes' => $changedAttributesString,
        ]);

        return redirect()->back()->with('success','Ingredient Stock successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $ingredient_stock = IngredientStock::find($id);
        $ingredient = Ingredient::find($ingredient_stock->ingredient_id);

        // Check if category exists
        if (!$ingredient_stock) {
            return redirect()->back()->with('error', 'Category not found');
        }

        // Capture the data before deleting the category
        $itemId = $ingredient_stock->id;
        $itemInStock = $ingredient_stock->in_stock;
        $itemDate = $ingredient_stock->date;
        $itemName = $ingredient->ingredient_name;

        $ingredient_stock->delete();

        // Log the activity
        ActivityLog::create([
            'action' => 'Deleted',
            'table_name' => 'Ingredients Stock',
            'user_id' => auth()->user()->id,
            'item_id' => $itemId,
            'item_category' => $itemInStock,
            'item_unit' => $itemDate,
            'item_name'=> $itemName


        ]);
        return redirect()->back()->with('success','Ingredient Stock successfully deleted');
    }

    /**
     * Delete expired ingredients and send notifications for ingredients close to expiration.
     *
     * 
     */
    public function deleteExpiredIngredients()
    {
        // Get current date
        $currentDate = Carbon::now();

        // Find expired ingredients
        $expiredIngredients = IngredientStock::where('expired_date', '<=', $currentDate)->get();

        // Log and delete expired ingredients
        foreach ($expiredIngredients as $ingredient_stock) {
            // Capture data before deleting
            $itemId = $ingredient_stock->id;
            $itemInStock = $ingredient_stock->in_stock;
            $itemDate = $ingredient_stock->date;
            $itemName = $ingredient_stock->ingredient_name;

            // Log the activity before deletion
            ActivityLog::create([
                'action' => 'Automatically Deleted',
                'table_name' => 'Ingredients Stock',
                'user_id' => 1,
                'item_id' => $itemId,
                'item_category' => $itemInStock,
                'item_unit' => $itemDate,
                'item_name'=> $itemName
            ]);

            // Delete the expired ingredient
            $ingredient_stock->delete();
    }

    }

    public function checkAndNotifyExpiredIngredients()
{
    // Check if notifications have already been sent for today
    $notificationSent = Cache::has('expired_ingredients_notification_sent');

    // If notifications haven't been sent yet, send them
    if (!$notificationSent) {
        // Get current date
        $currentDate = Carbon::now();

        // Find ingredients close to expiration (5 days before)
        $closeToExpirationIngredients = IngredientStock::whereDate('expired_date', '<=', $currentDate->addDays(5))->get();

        // Send notifications to all users for ingredients close to expiration
        $users = User::all();
        foreach ($users as $user) {
            foreach ($closeToExpirationIngredients as $ingredient_stock) {
                $user->notify(new IngredientsExpiredNotification($ingredient_stock));
            }
        }

        // Set flag to indicate that notifications have been sent for today
        Cache::put('expired_ingredients_notification_sent', true, now()->addDay());
    }
}
}
