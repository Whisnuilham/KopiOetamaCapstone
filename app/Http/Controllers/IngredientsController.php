<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\ActivityLog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
    
        // Define valid sort columns
        $validSortColumns = ['ingredient_name', 'category', 'unit', 'sum_of_stock'];
        if (!in_array($sortColumn, $validSortColumns)) {
            $sortColumn = 'created_at';
        }
    
        // Fetch ingredients with filtering
        $ingredientsQuery = Ingredient::with('stocks')
            ->when($request->has('search') && $request->search !== '', function ($query) use ($request) {
                $query->where('ingredient_name', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('category') && $request->category !== 'all', function ($query) use ($request) {
                $query->where('category', $request->category);
            });
    
        // Handle sorting
        if ($sortColumn === 'sum_of_stock') {
            // Fetch all ingredients and sort them by sum_of_stock in-memory
            $ingredients = $ingredientsQuery->get()->sortBy(function ($ingredient) {
                return $ingredient->sum_of_stock;
            }, SORT_REGULAR, $sortDirection === 'desc' ? true : false)->values();
        } else {
            // Sort by SQL columns directly
            $ingredients = $ingredientsQuery->orderBy($sortColumn, $sortDirection)->get();
        }
    
        // Paginate the sorted results (if needed)
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageResults = $ingredients->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $ingredientsPaginated = new LengthAwarePaginator(
            $currentPageResults,
            $ingredients->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    
        // Get authenticated user's notifications
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
    
        // Return view with data
        return view('pages.ingredients')->with([
            'ingredients' => $ingredientsPaginated,
            'notifications' => $notifications,
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection,
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

        $ingredient = Ingredient::create ([
            'ingredient_name'=>$request->ingredient_name,
            'category'=>$request->category,
            'unit'=>$request->unit,

        ]);

        ActivityLog::create([
            'action' => 'Created',
            'table_name' => 'Ingredients',
            'user_id' => auth()->user()->id,
            'item_id' => $ingredient->id,
            'item_category' => $ingredient->category,
            'item_unit' => $ingredient->unit,
            'item_name'=> $ingredient->ingredient_name
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
        // Validate the request data
        $request->validate([
            'ingredient_name' => 'required',
            'category' => 'required',
            'unit' => 'required',
        ]);

        // Find the ingredient by ID
        $ingredient = Ingredient::find($id);

        // If the ingredient doesn't exist, return with an error
        if (!$ingredient) {
            return redirect()->back()->with('error', 'Ingredient not found');
        }

        // Get the original attributes before updating
        $originalAttributes = $ingredient->getOriginal();

        // Update the ingredient with the new values
        $ingredient->update([
            'ingredient_name' => $request->ingredient_name,
            'category' => $request->category,
            'unit' => $request->unit,
        ]);

        
        // Initialize an empty string to store the changed attributes with old and new values
        $changedAttributesString = '';

        // Iterate over the changed attributes
        foreach ($ingredient->getChanges() as $attribute => $newValue) {
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
            'table_name' => 'Ingredients',
            'user_id' => auth()->user()->id,
            'item_id' => $ingredient->id,
            'item_category' => $ingredient->category,
            'item_unit' => $ingredient->unit,
            'item_name' => $ingredient->ingredient_name,
            'changed_attributes' => $changedAttributesString,
        ]);


        return redirect()->back()->with('success','Ingredient berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the ingredient
        $ingredient = Ingredient::find($id);

        // Check if category exists
        if (!$ingredient) {
            return redirect()->back()->with('error', 'Category not found');
        }

        // Capture the data before deleting the category
        $itemId = $ingredient->id;
        $itemName = $ingredient->ingredient_name;
        $itemCategory = $ingredient->category;
        $itemUnit = $ingredient->unit;

        // Delete the category
        $ingredient->delete();

        // Log the activity
        ActivityLog::create([
            'action' => 'Deleted',
            'table_name' => 'Ingredients',
            'user_id' => auth()->user()->id,
            'item_id' => $itemId,
            'item_category' => $itemCategory,
            'item_unit' => $itemUnit,
            'item_name'=> $itemName


        ]);
        return redirect()->back()->with('success','Ingredient berhasil di hapus');
    }
}

