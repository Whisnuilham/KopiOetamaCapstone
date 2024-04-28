<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IngredientStock;
use App\Models\Penjualan;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories=Category::all();
        $products=Product::all();
        $penjualans=Penjualan::
        when($request -> has('search'), function ($query) use($request){
            if ($request->search != '') {
                $query -> whereHas ('product', function($query2) use($request){
                    $query2 -> where('product_name','like','%'.$request -> search.'%');
                });
            }
        })

        ->when ($request -> has('category_id'), function ($query) use ($request){
            if ($request->category_id != '' && $request->category_id != 'all') {
                $query -> whereHas ('product', function($query2) use($request){
                    $query2 -> where ('category_id', $request -> category_id);
                });
            }

        })

        ->when ($request -> has('date'), function ($query) use ($request){
            if ($request->date != '') {
                $query -> where ('date', $request -> date);
            }
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        // Get authenticated user's notifications
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        
        return view('pages.penjualan')->with([
            'penjualans'=>$penjualans,
            'products'=>$products,
            'categories'=>$categories,
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
           'product_id'=>'required',
           'sold'=>'required',
           'date'=>'required',
       ]);

       $product=Product::find($request->product_id);
       if ($product) {
            // Inisialisasi variabel untuk menyimpan pesan kesalahan
            $errorMessages = [];

            $outStocks = [];

            // Loop melalui setiap bahan pada produk
            foreach ($product->ingredients as $key => $ingredient) {
                $quantity = $ingredient->pivot->quantity;
                $totalQty = $quantity * $request->sold;
                $outStocks[$key]['totalQty'] = $totalQty;
                $outStocks[$key]['ingredient_id'] = $ingredient -> id;
                if($totalQty > $ingredient -> sum_of_stock){
                    $errorMessages[] = "Stok untuk bahan {$ingredient->ingredient_name} tidak mencukupi. Tersedia: {$ingredient -> sum_of_stock}, Dibutuhkan: {$totalQty}";
                }
            }

            // Memeriksa apakah ada pesan kesalahan yang disimpan
            if (!empty($errorMessages)) {
                // Mengembalikan pengguna ke halaman sebelumnya dengan pesan kesalahan
                return redirect()->back()->withErrors($errorMessages);
            } else {
                foreach($outStocks as $key => $stock){
                    $ingredient_stock = IngredientStock::create ([
                        'ingredient_id' => $stock['ingredient_id'],
                        'out_stock' => $stock['totalQty'],
                        'date' => $request -> date,
                    ]);

                }
            }

        } else {
        // Mengembalikan pengguna ke halaman sebelumnya dengan pesan kesalahan jika produk tidak ditemukan
        return redirect()->back()->withErrors(['error' => 'Produk tidak ditemukan.']);
    }

       $penjualan=Penjualan::create ([
           'product_id'=>$request->product_id,
           'sold'=>$request->sold,
           'date'=>$request->date,

       ]);

       ActivityLog::create([
        'action' => 'Created',
        'table_name' => 'Sales',
        'user_id' => auth()->user()->id,
        'item_id' => $penjualan->id,
        'item_foreign_id' => $product->id,
        'item_name' => $product->product_name,
        'item_sold' => $penjualan->sold,
        'item_date' => $penjualan->date,
        ]);

       return redirect()->back()->with('success','New sales successfully added');

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
            'product_id'=>'required',
            'sold'=>'required',
            'date'=>'required',
        ]);

        $sales = Penjualan::find($id);
        $product=Product::find($sales->product_id);

        // Check if the sales exists
        if (!$sales) {
            return redirect()->back()->with('error', 'Sales not found');
        }

        // Get the original attributes before updating
        $originalAttributes = $sales->getOriginal();

       if ($product) {
            // Inisialisasi variabel untuk menyimpan pesan kesalahan
            $errorMessages = [];

            $outStocks = [];

            // Loop melalui setiap bahan pada produk
            foreach ($product->ingredients as $key => $ingredient) {
                $quantity = $ingredient->pivot->quantity;
                $totalQty = $quantity * $request->sold;
                $outStocks[$key]['totalQty'] = $totalQty;
                $outStocks[$key]['ingredient_id'] = $ingredient -> id;
                if($totalQty > $ingredient -> sum_of_stock){
                    $errorMessages[] = "Stok untuk bahan {$ingredient->ingredient_name} tidak mencukupi. Tersedia: {$ingredient -> sum_of_stock}, Dibutuhkan: {$totalQty}";
                }
            }

            // Memeriksa apakah ada pesan kesalahan yang disimpan
            if (!empty($errorMessages)) {
                // Mengembalikan pengguna ke halaman sebelumnya dengan pesan kesalahan
                return redirect()->back()->withErrors($errorMessages);
            } else {
                foreach($outStocks as $stock){
                    IngredientStock::create ([
                        'ingredient_id' => $stock['ingredient_id'],
                        'out_stock' => $stock['totalQty'],
                        'date' => $request -> date,
                    ]);
                }
            }

        } else {
        // Mengembalikan pengguna ke halaman sebelumnya dengan pesan kesalahan jika produk tidak ditemukan
        return redirect()->back()->withErrors(['error' => 'Produk tidak ditemukan.']);
    }

        $sales->update ([
            'product_id'=>$request->product_id,
            'sold'=>$request->sold,
            'date'=>$request->date,

        ]);

        // Initialize an empty string to store the changed attributes with old and new values
        $changedAttributesString = '';

        // Iterate over the changed attributes
        foreach ($sales->getChanges() as $attribute => $newValue) {
            // Get the previous value of the attribute
            $oldValue = $originalAttributes[$attribute];

            // Concatenate the attribute name, old value, and new value to the string
            $changedAttributesString .= "$attribute: $oldValue => $newValue, ";
        }
        
        // Remove the trailing comma and space
        $changedAttributesString = rtrim($changedAttributesString, ', ');

        ActivityLog::create([
            'action' => 'Updated',
            'table_name' => 'Sales',
            'user_id' => auth()->user()->id,
            'item_id' => $sales->id,
            'item_foreign_id' => $product->id,
            'item_name' => $product->product_name,
            'item_sold' => $sales->sold,
            'item_date' => $sales->date,
            'changed_attributes' => $changedAttributesString
            ]);


        return redirect()->back()->with('success','Sales successfully updated');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $sales = Penjualan::find($id);
        $product=Product::find($sales->product_id);

        // Check if the sales exists
        if (!$sales) {
            return redirect()->back()->with('error', 'Sales not found');
        }
        
        // Capture the data before deleting the sales
        $itemId = $sales->id;
        $itemSold = $sales->sold;
        $itemDate = $sales->date;
        $itemForeignID = $product->id;
        $itemName = $product->product_name;
        
        $sales->delete();

        ActivityLog::create([
            'action' => 'Deleted',
            'table_name' => 'Sales',
            'user_id' => auth()->user()->id,
            'item_id' => $itemId,
            'item_foreign_id' => $itemForeignID,
            'item_name' => $itemName,
            'item_sold' => $itemSold,
            'item_date' => $itemDate,
            ]);


        return redirect()->back()->with('success','Penjualan berhasil di hapus');
    }
}
