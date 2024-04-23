<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::paginate(10);
        return view('pages.category')->with([
            'categories'=>$categories

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
            'name'=>'required',

        ]);

        $category = Category::create ([
            'name'=>$request->name,

        ]);

        ActivityLog::create([
            'action' => 'Created',
            'table_name' => 'Product Categories',
            'user_id' => auth()->user()->id,
            'item_id' => $category->id,
            'item_name'=> $category->name
        ]);

        

        return redirect()->back()->with('success','Category berhasil ditambahkan');
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
            'name'=>'required',

        ]);

        // Find the category
        $category = Category::find($id);

        // Check if the category exists
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        // Get the original attributes before updating
        $originalAttributes = $category->getOriginal();

        // Update the category
        $category->update([
            'name' => $request->name,
        ]);

        // Initialize an empty string to store the changed attributes with old and new values
        $changedAttributesString = '';

        // Iterate over the changed attributes
        foreach ($category->getChanges() as $attribute => $newValue) {
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
            'table_name' => 'Product Categories',
            'user_id' => auth()->user()->id,
            'item_id' => $category->id,
            'item_name'=> $category->name,
            'changed_attributes' => $changedAttributesString
        ]);

        return redirect()->back()->with('success','Category berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the category
        $category = Category::find($id);

        // Check if category exists
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        // Capture the data before deleting the category
        $itemId = $category->id;
        $itemName = $category->name;

        // Delete the category
        $category->delete();

        // Log the activity
        ActivityLog::create([
            'action' => 'Deleted',
            'table_name' => 'Product Categories',
            'user_id' => auth()->user()->id,
            'item_id' => $itemId,
            'item_name'=> $itemName


        ]);
        return redirect()->back()->with('success','Category successfully Deleted');
    }
}
