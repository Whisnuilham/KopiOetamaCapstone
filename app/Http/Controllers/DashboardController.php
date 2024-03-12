<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Penjualan;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalproduct = Product::count();
        $totaluser = User::count();
        $totalingredient = Ingredient::count();
        $filterChart = $request->filterChart;
        $filterTop = $request->filterTop;


        // Menginisialisasi tanggal awal dan akhir
        $chartdate = "";
        $topdate = "";
        $startDate = null;
        $endDate = null;
        $previousStartDate = null;
        $previousEndDate = null;

        // Mengatur rentang tanggal berdasarkan filter
        switch ($filterChart) {
            case 'yesterday':
                $startDate = Carbon::yesterday()->startOfDay();
                $endDate = Carbon::yesterday()->endOfDay();
                $previousStartDate = Carbon::now()->subDays(2)->startOfDay(); // Awal dari 2 hari yang lalu
                $previousEndDate = Carbon::now()->subDays(2)->endOfDay(); // Akhir dari 2 hari yang lalu
                $chartdate = Carbon::yesterday() -> format('d F Y');
                break;
            case 'today':
                $startDate = Carbon::today()->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                $previousStartDate = Carbon::now()->subDays(1)->startOfDay(); // Awal dari 1 hari yang lalu
                $previousEndDate = Carbon::now()->subDays(1)->endOfDay(); // Akhir dari 1 hari yang lalu
                $chartdate = Carbon::today() -> format('d F Y');
                break;
            case 'last_7_days':
                $startDate = Carbon::now()->subDays(6)->startOfDay(); // Mulai dari 7 hari yang lalu
                $endDate = Carbon::now()->endOfDay();
                $previousStartDate = Carbon::now()->subDays(13)->startOfDay(); // Awal dari 14 hari yang lalu
                $previousEndDate = Carbon::now()->subDays(7)->endOfDay(); // Akhir dari 7 hari yang lalu
                $chartdate = $startDate->format('d F Y') . " - " . $endDate->format('d F Y');
                break;
            case 'last_30_days':
                $startDate = Carbon::now()->subDays(29)->startOfDay(); // Mulai dari 30 hari yang lalu
                $endDate = Carbon::now()->endOfDay();
                $previousStartDate = Carbon::now()->subDays(60)->startOfDay(); // Awal dari 60 hari yang lalu
                $previousEndDate = Carbon::now()->subDays(31)->endOfDay(); // Akhir dari 31 hari yang lalu
                $chartdate = $startDate->format('d F Y') . " - " . $endDate->format('d F Y');
                break;
            default:
                // Filter default jika tidak ada yang sesuai
                $startDate = Carbon::now()->subDays(6)->startOfDay(); // Default ke 7 hari yang lalu
                $endDate = Carbon::now()->endOfDay();
                $previousStartDate = Carbon::now()->subDays(13)->startOfDay(); // Default ke 14 hari yang lalu
                $previousEndDate = Carbon::now()->subDays(7)->endOfDay(); // Default ke 7 hari yang lalu
                $chartdate = $startDate->format('d F Y') . " - " . $endDate->format('d F Y');
                break;
        }

        // Mengambil data penjualan berdasarkan rentang tanggal
        $salesData = Penjualan::whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();

        $previousSalesData = Penjualan::whereBetween('date', [$previousStartDate, $previousEndDate])
            ->orderBy('date')
            ->get();

        $dailySales = [];
        $previousSales = [];

        foreach ($salesData as $sale) {
            $date = $sale->date->format('d M Y'); // Mengambil tanggal penjualan
            $dailySales[$date] = $sale->sold; // Menyimpan jumlah penjualan per hari
        }
        foreach ($previousSalesData as $previousSale) {
            $date = $previousSale->date->format('d M Y'); // Mengambil tanggal penjualan
            $previousSales[$date] = $previousSale->sold; // Menyimpan jumlah penjualan per hari
        }

        // Inisialisasi array untuk tanggal dan data penjualan
        $chartData = [
            'dates' => [],
            'sales' => [],
            'previousSale' => [],
        ];

        // Mengisi array dengan tanggal dan data penjualan
        $currentDate = $startDate;
        $previousDate = $previousStartDate;
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->format('d M Y');
            $previousDateString = $previousStartDate->format('d M Y');
            $chartData['dates'][] = $dateString; // Menambahkan tanggal ke array
            $chartData['sales'][] = isset($dailySales[$dateString]) ? $dailySales[$dateString] : 0; // Menambahkan jumlah penjualan ke array, jika tidak ada data, maka 0
            $chartData['previousSale'][] = isset($previousSales[$previousDateString]) ? $previousSales[$previousDateString] : 0; // Menambahkan jumlah penjualan ke array, jika tidak ada data, maka 0
            $currentDate->addDay(); // Melanjutkan ke hari berikutnya
            $previousDate->addDay();
        }

        // dd($chartData, $salesData);
        $topstartDate = null;
        $topendDate = null;

        switch ($filterTop) {
            case 'yesterday':
                $topstartDate = Carbon::yesterday()->startOfDay();
                $topendDate = Carbon::yesterday()->endOfDay();
                $topdate = Carbon::yesterday() -> format('d F Y');
                break;
            case 'today':
                $topstartDate = Carbon::today()->startOfDay();
                $topendDate = Carbon::today()->endOfDay();
                $topdate = Carbon::today() -> format('d F Y');
                break;
            case 'last_7_days':
                $topstartDate = Carbon::now()->subDays(6)->startOfDay(); // Mulai dari 7 hari yang lalu
                $topendDate = Carbon::now()->endOfDay();
                $topdate = $topstartDate->format('d F Y') . " - " . $topendDate->format('d F Y');
                break;
            case 'last_30_days':
                $topstartDate = Carbon::now()->subDays(29)->startOfDay(); // Mulai dari 30 hari yang lalu
                $topendDate = Carbon::now()->endOfDay();
                $topdate = $topstartDate->format('d F Y') . " - " . $topendDate->format('d F Y');
                break;
            default:
                // Filter default jika tidak ada yang sesuai
                $topstartDate = Carbon::now()->subDays(6)->startOfDay(); // Default ke 7 hari yang lalu
                $topendDate = Carbon::now()->endOfDay();
                $topdate = $topstartDate->format('d F Y') . " - " . $topendDate->format('d F Y');
                break;
        }

        $salesData = Penjualan::whereBetween('date', [$topstartDate, $topendDate])
            ->selectRaw('product_id, SUM(sold) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Mengambil data produk yang paling banyak terjual
        $topSellingProducts = [];
        foreach ($salesData as $sale) {
            $topSellingProducts[] = [
                'product_name' => $sale->product->product_name,
                'total_sold' => $sale->total_sold,
            ];
        }

        // dd($salesData, $topSellingProducts);
        return view('dashboard')->with([
            'totalproduct' => $totalproduct,
            'totaluser' => $totaluser,
            'totalingredient' => $totalingredient,
            'chartData' => $chartData,
            'topSellingProducts' => $topSellingProducts,
            'chartdate' => $chartdate,
            'topdate' => $topdate,
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
    }


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
    }


    public function destroy(string $id)
    {
        //

    }
}
