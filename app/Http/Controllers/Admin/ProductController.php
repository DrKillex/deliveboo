<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;


use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Index
    public function index()
    {
        $products = Product::all();
        // prendiamo il file index dentro la cartella admin->products usando la dot notation
        return view('admin.products.index', compact('products'));
    }

    // Create
    public function create()
    {
        return view('admin.products.create');
    }

    // Store
    public function store(StoreProductRequest $request)
    {
        $restaurant_id = auth()->user()->restaurant->id;
        $restaurant = Restaurant::where('id', $restaurant_id)->get();
        $restaurant = $restaurant[0]->slug;
        $data = $request->validated();
        $product = new Product();
        $product->slug =  Str::slug($data['name']);
        $product->restaurant_id = $restaurant_id;
        $product->fill($data);
        // immagine
        $product->slug =  Str::slug($data['name']);
        if (isset($data['image'])) {
            $product->image = Storage::put('uploads', $data['image']);
        }
        if (!isset($data['vegan'])) {
            $product->vegan = 0;
        }
        if (!isset($data['gluten_free'])) {
            $product->gluten_free = 0;
        }
        if (!isset($data['visible'])) {
            $product->visible = 0;
        }
        $product->save(); 
        return redirect()->route('admin.restaurants.show', compact('restaurant'))->with('message', 'Nuovo prodotto aggiunto');
    }

    // Show
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Edit
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update
    public function update(UpdateProductRequest $request, Product $product){
        $restaurant_id = auth()->user()->restaurant->id;
        $restaurant = Restaurant::where('id', $restaurant_id)->get();
        $restaurant = $restaurant[0]->slug;
        $data = $request->validated();
        $product->slug =  Str::slug($data['name']);
        // immagine
        if (isset($data['image'])) {
            if($product->image){
                Storage::delete($product->image);
            }
            $data['image'] = Storage::put('uploads', $data['image']);
        }
        // immagine
        $product->update($data);
        return redirect()->route('admin.restaurants.show', compact('restaurant'))->with('message', 'Nuovo prodotto aggiunto');
    }

    // Destroy
    public function destroy(Product $product)
    {
        $old_id = $product->id;
        // immagine
        if($product->image){
            Storage::delete($product->image);
        }
        $product->delete();
        // immagine
        return redirect()->route('admin.products.index')->with('message', "Il $old_id Prodotto è stato rimosso");
    }
}