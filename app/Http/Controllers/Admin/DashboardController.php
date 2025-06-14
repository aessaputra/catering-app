<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:is-admin');
    }

    public function index()
    {
        // 1. Statistik untuk Info Box
        $productCount = Product::count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        $userCount = User::count();

        // 2. Data untuk Tabel Pesanan Terbaru
        $recentOrders = Order::latest()->take(5)->get();

        // 3. Data untuk Grafik Penjualan (7 Hari Terakhir)
        $salesData = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
            
        // Proses data untuk format yang dibutuhkan Chart.js
        $chartLabels = $salesData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        });
        $chartData = $salesData->pluck('total');


        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'productCount',
            'pendingOrdersCount',
            'totalRevenue',
            'userCount',
            'recentOrders',
            'chartLabels',
            'chartData'
        ));
    }
}