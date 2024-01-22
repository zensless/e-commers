<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    //
    public function index()
    {
        // produk berelasi dengan jenis_produk
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama AS jenis')
        ->get();
        return new ProdukResource(true, 'Data Produk', $produk);
    }

    public function show($id) {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama AS jenis')
        ->where('produk.id', $id)
        ->get();
        return new ProdukResource(true, 'Detail Produk', $produk);
    }

    public function store(Request $request) {
        // $request->validate([

        $validator = Validator::make($request->all(),[
            'kode'=> 'required | max:10 | unique:produk',
            'nama'=> 'required | max:45',
            'harga_beli'=> 'required | numeric',
            'harga_jual'=> 'required | numeric',
            'stok'=> 'required | numeric',
            'min_stok'=> 'required | numeric',
            'deskripsi'=> 'nullable | string | min:10',
            'jenis_produk_id'=> 'required | integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 442);
        }

        DB::table('produk')->insert([
            'kode'=> $request->input('kode'),
            'nama'=> $request->input('nama'),
            'harga_beli'=> $request->input('harga_beli'),
            'harga_jual'=> $request->input('harga_jual'),
            'stok'=> $request->input('stok'),
            'min_stok'=> $request->input('min_stok'),
            'foto' => $request->input('foto'),
            'deskripsi'=> $request->input('deskripsi'),
            'jenis_produk_id'=> $request->input('jenis_produk_id'),
        ]);

        return new ProdukResource(true, 'Data Produk Berhasil ditambahkan', 'produk');
    }

    public function update(Request $request, string $id) {
        $validator = Validator::make($request->all(),[
            'kode'=> 'required | max:10',
            'nama'=> 'required | max:45',
            'harga_beli'=> 'required | numeric',
            'harga_jual'=> 'required | numeric',
            'stok'=> 'required | numeric',
            'min_stok'=> 'required | numeric',
            'deskripsi'=> 'nullable | string | min:10',
            'jenis_produk_id'=> 'required | integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 442);
        }

        $produk = DB::table('produk')->where('id',$id)->update([
            'kode'=> $request->input('kode'),
            'nama'=> $request->input('nama'),
            'harga_beli'=> $request->input('harga_beli'),
            'harga_jual'=> $request->input('harga_jual'),
            'stok'=> $request->input('stok'),
            'min_stok'=> $request->input('min_stok'),
            'foto' => $request->input('foto'),
            'deskripsi'=> $request->input('deskripsi'),
            'jenis_produk_id'=> $request->input('jenis_produk_id'),
        ]);

        return new ProdukResource(true, 'Data Produk Berhasil diubah', $produk);
    }

    public function destory($id) {
        $produk = DB::table('produk')->where('id', $id);
        $produk->delete();
        return new ProdukResource(true, 'Data Produk Berhasil dihapus', $produk);
    }
}
