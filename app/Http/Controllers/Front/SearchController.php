<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // Import the Cache facade
use App\Models\Product; // Import the Product model
use Cart;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->get('q');

        // Retrieve search results from cache or database
        $products = Cache::remember("search_results_{$keyword}", 60, function () use ($keyword) {
            return Product::whereRaw("MATCH(name, description) AGAINST(? IN BOOLEAN MODE)", [$keyword])->get();
        });
        $content=Cart::content();

        // Return view with search results
        return view('frontend.search', ['products' => $products, 'keyword' => $keyword, 'content' => $content]);
    }
    
}
