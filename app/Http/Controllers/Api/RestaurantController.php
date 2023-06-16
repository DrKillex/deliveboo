<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use function PHPUnit\Framework\isEmpty;

class RestaurantController extends Controller
{
    public function index()
    {
        // $restaurants = Restaurant::all()->paginate(5);
        $restaurants = Restaurant::with('categories')->get();

        if(count($restaurants)>0){
            return response()->json([
                'success' => true,
                'results' => $restaurants
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => null
            ], 404);
        }


    }

    public function show(string $slug)
    {

        $restaurants = Restaurant::where('slug', $slug)->with('categories', 'products')->get();

        if(count($restaurants)>0){
            return response()->json([
                'success' => true,
                'results' => $restaurants
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => null
            ], 404);
        }
    }
}
