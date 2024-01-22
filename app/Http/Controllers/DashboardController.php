<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Jenis_produk;
use App\Models\Kartu;

class DashboardController extends Controller
{
    // fungsi index
    public function index() {
        $produk = Produk::count();
        $pelanggan = Pelanggan::count();
        $jenis_produk = Jenis_produk::count();
        $kartu = Kartu::count();

        $jenis_kelamin = DB::table('pelanggan')
        ->selectRaw('jk, count(jk) as jumlah')
        ->groupBy('jk')
        ->get();

        $hitung_harga = DB::table('produk')
        ->select('nama', 'harga_jual')
        ->get();

        return view("admin.dashboard", compact('produk', 'pelanggan', 'jenis_produk', 'kartu', 'jenis_kelamin', 'hitung_harga')); // mengarahkan ke file dashboard yang ada di dalam admin
    }
}
