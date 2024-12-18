<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ReportsController extends Controller
{

    public function ProductsWithCategory()
    {
        $products = Product::with('category:id,name')->get();
        
        return response()->json([ 
            'success' => true, 
            'data' => $products 
        ], 200);
    }


    public function ProductsOrdered()
    {
        $products = Product::orderBy('price', 'asc')->get();
        
        return response()->json([ 
            'success' => true, 
            'data' => $products 
        ], 200);
    }


    public function ProductsZeroStock()
    {
        $products = Product::where('stock', 0)->get();
        
        return response()->json([ 
            'success' => true, 
            'data' => $products 
        ], 200);
    }


    public function ProductStockTen()
    {
        $products = Product::where('stock', '>', 10)->get();
        
        return response()->json([ 
            'success' => true, 
            'data' => $products 
        ], 200);
    }
}
