<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    //
    public function index() {
        $produk = Produk::where('jenis_produk_id', 4)->get();
        return view('beranda', compact('produk'));
    }
}
