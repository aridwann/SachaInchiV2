<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $productId = (string) $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $request->input('name'),
                'price' => (int) $request->input('price'),
                'img' => $request->input('img'),
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk sudah ditambahkan ke dalam keranjang!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function update($id, $qty)
    {
        $cart = session()->get('cart', []);
        $id = (string) $id;
        $qty = max((int) $qty, 1); // minimal qty 1

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Jumlah berhasil diperbarui',
            'cart' => $cart,
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        $id = (string) $id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus',
            'cart' => $cart,
        ]);
    }

    public function removeSelected(Request $request)
    {
        $ids = $request->input('ids', []);

        foreach ($ids as $id) {
            if (session()->has("cart.$id")) {
                session()->forget("cart.$id");
            }
        }

        return response()->json(['success' => true]);
    }

    public function clear(){
        session()->forget('cart');
        return response()->json(['success' => true]);
    }
}
