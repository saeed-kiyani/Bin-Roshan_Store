<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalCategories = Category::count();

        $activeProducts = Product::where('is_active', true)->count();

        $featuredProducts = Product::where('is_featured', true)->count();

        $lowStockProducts = Product::where('stock', '<=', 5)->count();

        $outOfStockProducts = Product::where('stock', 0)->count();

        $recentProducts = Product::query()
            ->with([
                'category',
                'primaryImage',
            ])
            ->latest()
            ->take(5)
            ->get();

        $recentCategories = Category::query()
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'activeProducts',
            'featuredProducts',
            'lowStockProducts',
            'outOfStockProducts',
            'recentProducts',
            'recentCategories'
        ));
    }
}