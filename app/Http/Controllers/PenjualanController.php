<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IngredientStock;
use App\Models\Penjualan;
use App\Models\Product;
use Illuminate\Http\Request;

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
        
        return view('pages.penjualan')->with([
            'penjualans'=>$penjualans,
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

       $penjualan=Penjualan::create ([
           'product_id'=>$request->product_id,
           'sold'=>$request->sold,
           'date'=>$request->date,

       ]);

       return redirect()->back()->with('success','Penjualan berhasil diupdate');

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

        Penjualan::find($id)->update ([
            'product_id'=>$request->product_id,
            'sold'=>$request->sold,
            'date'=>$request->date,

        ]);


        return redirect()->back()->with('success','Penjualan berhasil diupdate');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Penjualan::find($id)->delete();
        return redirect()->back()->with('success','Penjualan berhasil di hapus');
    }
}
