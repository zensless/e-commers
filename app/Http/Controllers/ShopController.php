<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index() {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama AS jenis')
        ->get();
        return view('shop', compact('produk'));
    }

    public function cart()
    {   
        // panggil produk yang sudah masuk kedalam cart
        $products = Produk::all();
        $cart = session()->get('cart');
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama AS jenis')
        ->get();

        // hitung total
        $total = 0;
        if($cart) {
            foreach ($cart as $key => $produk) {
                $total += $produk['harga_jual'] * $produk['quantity'];
            }
            
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
    
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    // 'order_id' => $products->id,
                    'gross_amount' => $total,
                ),
                'customer_details' => array(
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ),
            );
    
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            return view('cart', compact('snapToken', 'total', 'cart'));
        }

        return view('shop', compact('produk'));

    }

    public function addToCart($id)
    {
        $product = Produk::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nama" => $product->nama,
                "quantity" => 1,
                "harga_jual" => $product->harga_jual,
                "foto" => $product->foto
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk Berhasil ditambahkan ke Keranjang!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
