<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Penjualan;
use App\Models\Product;
use App\Models\IngredientStock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalproduct = Product::count();
        $today = Carbon::now();
        $nextWeek = Carbon::now()->addWeek();

        $totalExpiredSoon = IngredientStock::whereBetween('expired_date', [$today, $nextWeek])->count();
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


        
        //Inisialisasi array untuk menyimpan jumlah penjualan setiap hari
        $dailySales = [];

        // Inisialisasi array untuk menyimpan total penjualan harian
        $totalSales = [];

        foreach ($salesData as $sale) {
            $date = $sale->date->format('d M Y'); // Mengambil tanggal penjualan

            // Inisialisasi sales count harian untuk produk jika belum ada
            if (!isset($dailySales[$date])) {
                $dailySales[$date] = [];
            }

            // Menyimpan jumlah penjualan per hari untuk produk tertentu
            if (!isset($dailySales[$date][$sale->product_name])) {
                $dailySales[$date][$sale->product_name] = 0;
            }
            $dailySales[$date][$sale->product_name] += $sale->sold;

            // Menambahkan jumlah penjualan per hari ke total penjualan harian
            if (!isset($totalSales[$date])) {
                $totalSales[$date] = 0;
            }
            $totalSales[$date] += $sale->sold;
        }

        $last7Days = Carbon::now()->subDays(7);

        $products = Product::with(['penjualan' => function ($query) use ($last7Days) {
            $query->where('created_at', '>=', $last7Days);
        }])->get();
    
        $totalProducts = $products->sum(function($product) {
            return $product->penjualan->sum('quantity');
        });
        // Inisialisasi array untuk tanggal dan data penjualan
        $chartData = [
            'dates' => ['2024-06-01', '2024-06-02', '2024-06-03', '2024-06-04', '2024-06-05'],
            'total_sales' => ['10 Cup', '15 Cup', '20 Cup', '25 Cup', '30 Cup'],
            'additional_series_1' => ['5 Cup', '10 Cup', '15 Cup', '20 Cup', '25 Cup'],
            'additional_series_2' => ['20 Cup', '18 Cup', '25 Cup', '30 Cup', '40 Cup'],
            'additional_series_3' => ['8 Cup', '12 Cup', '14 Cup', '22 Cup', '35 Cup'],
            'additional_series_4' => ['17 Cup', '25 Cup', '23 Cup', '19 Cup', '28 Cup'],
        ];
        
        // $chartData = [
        //     'dates' => [],
        //     'products' => [], // Changed 'sales' key to 'products' to reflect product-wise sales
        //     'total_sales' => [], // Added 'total_sales' key to store total sales across all products for each day
        // ];

        // // Mengisi array dengan tanggal dan data penjualan total dan setiap produk
        // $currentDate = clone $startDate;
        // while ($currentDate <= $endDate) {
        //     $dateString = $currentDate->format('d M Y');
            
        //     // Menambahkan tanggal ke array
        //     $chartData['dates'][] = $dateString;
        
        //     // Menambahkan jumlah penjualan untuk setiap produk ke array
        //     if (isset($dailySales[$dateString])) {
        //         foreach ($dailySales[$dateString] as $product => $sales) {
        //             // Jika produk belum ada pada array, inisialisasi dengan 0 penjualan
        //             if (!isset($chartData['products'][$product])) {
        //                 $chartData['products'][$product] = [];
        //             }
        //             $chartData['products'][$product][] = $sales; // Menambahkan penjualan produk ke array
        //         }
        //     } else {
        //         // Jika tidak ada penjualan pada tanggal tertentu, inisialisasi semua produk dengan 0 penjualan
        //         foreach ($chartData['products'] as $product => $salesArray) {
        //             $chartData['products'][$product][] = 0;
        //         }
        //     }
        
        //     // Menambahkan total penjualan untuk hari ini ke array
        //     $chartData['total_sales'][] = isset($totalSales[$dateString]) ? $totalSales[$dateString] : 0;
        
        //     $currentDate->addDay(); // Melanjutkan ke hari berikutnya
        // }

        // dd($chartData, $salesData);
        $topstartDate = null;
        $topendDate = null;

        $topdate = ''; // Initialize $topdate variable

    $filterTop = $request->query('filterTop', 'last_7_days'); // Default to 'last_7_days' if filterTop is not provided

    switch ($filterTop) {
        case 'yesterday':
            $startDate = Carbon::yesterday()->startOfDay();
            $endDate = Carbon::yesterday()->endOfDay();
            $topdate = 'Yesterday';
            break;
        case 'today':
            $startDate = Carbon::today()->startOfDay();
            $endDate = Carbon::today()->endOfDay();
            $topdate = 'Today';
            break;
        case 'last_7_days':
            $startDate = Carbon::today()->subDays(6)->startOfDay();
            $endDate = Carbon::today()->endOfDay();
            $topdate = 'Last 7 days';
            break;
        case 'last_30_days':
            $startDate = Carbon::today()->subDays(29)->startOfDay();
            $endDate = Carbon::today()->endOfDay();
            $topdate = 'Last 30 days';
            break;
        default:
            $startDate = Carbon::today()->subDays(6)->startOfDay();
            $endDate = Carbon::today()->endOfDay();
            $topdate = 'Last 7 days';
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
        $totalSoldSum = 0; // Initialize $totalSoldSum

        foreach ($salesData as $sale) {
            $topSellingProducts[] = [
                'product_name' => $sale->product->product_name,
                'total_sold' => $sale->total_sold,
            ];
            // Mengakumulasi nilai total_sold dari setiap produk
            $totalSoldSum += $sale->total_sold;
        }

        // Add the total_sold sum to the array
        /* $topSellingProducts['total_sold_sum'] = $totalSoldSum;
 */
        // dd($salesData, $topSellingProducts);

        // Get authenticated user's notifications
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        //dd ($notifications);


        $today = now()->format('Y-m-d');
      
        $ingredients_stocks = DB::table('ingredient_stocks')
            ->join('ingredients', 'ingredient_stocks.ingredient_id', '=', 'ingredients.id')
            ->selectRaw('ingredients.unit, ingredients.ingredient_name, SUM(ingredient_stocks.out_stock) as total_out_stock')
            ->whereBetween('ingredient_stocks.created_at', [$startDate, $endDate])
            ->groupBy('ingredients.unit', 'ingredients.ingredient_name')
            ->paginate(8)
            ->withQueryString();
        

        return view('dashboard')->with([
            'totalproduct' => $totalProducts,
            'product' => $products,
            'totalexpired' => $totalExpiredSoon,
            'totalingredient' => $totalingredient,
            'chartData' => $chartData,
            'topSellingProducts' => $topSellingProducts,
            'totalSoldSum' => $totalSoldSum,
            'chartdate' => $chartdate,
            'topdate' => $topdate,
            'notifications' => $notifications,
            'ingredient_stocks'=>$ingredients_stocks,

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
