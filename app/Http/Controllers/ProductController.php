<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public static function index(){
        return view('products');
    }

    public static function getTop(){
        return view('landingpage', [
            'products' => Product::where('ishide', false)->take(3)->get()
        ]);
    }

    public function edit(Product $product)
    {
        return view('edit-product', compact('product'));
    }

    public function show(Product $product){
        return view('detail-product', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|in:Tersedia,Kosong', 
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);
        
        if ($request->hasFile('img')) {
            if (!str_contains($product->img, 'img/')) {
                Storage::disk(config('filesystems.default_public_disk'))->delete(str_replace('storage/', '', $product->img));
            }
            $validated['img'] = 'storage/'.$request->file('img')->store('product-images', config('filesystems.default_public_disk'));
        }
    
        $product->update($validated);
        
        return redirect("/dashboard")->with('success', 'Produk berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|in:Tersedia,Kosong', 
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);
        
        if ($request->hasFile('img')) {
            $validated['img'] = 'storage/'.$request->file('img')->store('product-images', config('filesystems.default_public_disk'));
        }

        Product::create($validated);        
        return redirect("/dashboard")->with('success', 'Produk berhasil ditambahkan.');
    }

    public function create()
    {
        return view('create-product');
    }
}
