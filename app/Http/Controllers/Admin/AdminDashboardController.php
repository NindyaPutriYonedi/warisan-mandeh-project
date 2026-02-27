<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $newOrders     = Order::where('status', 'pending')->count();
        $averageRating = Review::avg('rating') ?? 0;

        $totalIncome = Order::where('status', 'terkirim')
            ->sum('total_price');

        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate   = Carbon::now()->endOfMonth();

        $salesData = Order::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as ym"),
                DB::raw('SUM(total_price) as total')
            )
            ->where('status', 'terkirim')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('ym')
            ->orderBy('ym')
            ->get()
            ->pluck('total', 'ym')
            ->toArray();

        $months = [];
        $sales  = [];

        $cursor = $startDate->copy();
        while ($cursor <= $endDate) {
            $key = $cursor->format('Y-m');
            $months[] = $cursor->format('M Y');
            $sales[]  = $salesData[$key] ?? 0;
            $cursor->addMonth();
        }

        $pendingOrders = Order::where('status', 'pending')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'newOrders',
            'averageRating',
            'totalIncome',
            'months',
            'sales',
            'pendingOrders'
        ));
    }
}
