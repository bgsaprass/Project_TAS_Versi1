<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Revenue weekly (sum total for last 7 days)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $totalRevenueThisWeek = Order::where('status', 'paid')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('total');

        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();
        $totalRevenueLastWeek = Order::where('status', 'paid')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('total');

        $revenueGrowthPercent = $totalRevenueLastWeek > 0
            ? round((($totalRevenueThisWeek - $totalRevenueLastWeek) / $totalRevenueLastWeek) * 100, 1)
            : 0;

        // Weekly chart: last 7 days
        $weeklyData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->where('status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Fill missing dates with 0
        $labels = [];
        $totals = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = Carbon::now()->subDays($i)->toDateString();
            $labels[] = Carbon::parse($d)->format('d M');
            $found = $weeklyData->firstWhere('date', $d);
            $totals[] = $found ? (int)$found->total : 0;
        }

        // Latest transactions
        $latestTransactions = Order::with('user')->latest()->limit(6)->get();

        // Middle metrics
        $newProductsCount = Product::where('created_at', '>=', $startOfWeek)->count();
        $newProductsGrowth = 14.6; // placeholder, bisa hitung dari minggu lalu jika ada data

        $visitorsThisWeek = 5355; // placeholder jika belum ada tabel analytics/visitors
        $visitorsGrowth = 32.9;

        $userSignupsThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $userSignupsLastWeek = User::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();
        $userSignupsGrowth = $userSignupsLastWeek > 0
            ? round((($userSignupsThisWeek - $userSignupsLastWeek) / $userSignupsLastWeek) * 100, 1)
            : ($userSignupsThisWeek > 0 ? 100 : 0);

        // Latest customers: last paid orders grouped by user
        $latestCustomers = Order::select('user_id', DB::raw('MAX(created_at) as last_date'), DB::raw('MAX(total) as last_total'))
            ->where('status', 'paid')
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('last_date', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($row) {
                $row->name = $row->user?->name ?? 'Guest';
                $row->email = $row->user?->email ?? '-';
                return $row;
            });

        // Acquisition overview (static unless you track sources)
        $acquisition = [
            ['channel' => 'Organic Search', 'users' => 5649, 'percent' => 30, 'barClass' => 'bg-cyan-600'],
            ['channel' => 'Referral',       'users' => 4025, 'percent' => 24, 'barClass' => 'bg-orange-300'],
            ['channel' => 'Direct',         'users' => 3105, 'percent' => 18, 'barClass' => 'bg-teal-400'],
            ['channel' => 'Social',         'users' => 1251, 'percent' => 12, 'barClass' => 'bg-pink-600'],
            ['channel' => 'Other',          'users' => 734,  'percent' => 9,  'barClass' => 'bg-indigo-600'],
            ['channel' => 'Email',          'users' => 456,  'percent' => 7,  'barClass' => 'bg-purple-500'],
        ];

        return view('admin.index', [
            'totalRevenueThisWeek' => $totalRevenueThisWeek,
            'revenueGrowthPercent' => $revenueGrowthPercent,
            'weeklyLabels' => $labels,
            'weeklyTotals' => $totals,
            'latestTransactions' => $latestTransactions,
            'newProductsCount' => $newProductsCount,
            'newProductsGrowth' => $newProductsGrowth,
            'visitorsThisWeek' => $visitorsThisWeek,
            'visitorsGrowth' => $visitorsGrowth,
            'userSignupsThisWeek' => $userSignupsThisWeek,
            'userSignupsGrowth' => $userSignupsGrowth,
            'latestCustomers' => $latestCustomers,
            'acquisition' => $acquisition,
        ]);
    }
}
