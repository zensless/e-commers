<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// pemanggilan models  didalam controller
use App\Models\Jenis_produk;
use App\Models\Produk;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // sintaks menggunakan elequent (ORM)
        $jenis_produk = Jenis_produk::all();
        return view("admin.jenis.index", compact("jenis_produk"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
        return view("admin.jenis.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // tambah data eloquent
        $jenis_produk = new Jenis_produk;
        $jenis_produk->nama = $request->nama;
        $jenis_produk->save();
        return redirect("admin/jenis_produk");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
        $jenis_produk = Jenis_produk::all()->where("id", $id);
        return view("admin.jenis.detail", compact("jenis_produk"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 
        $jenis_produk = Jenis_produk::all()->where("id", $id);
        return view("admin.jenis.edit", compact("jenis_produk"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 
        $jenis_produk = Jenis_produk::find($request->id);
        $jenis_produk->nama = $request->nama;
        $jenis_produk->save();

        return redirect("admin/jenis_produk");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 
        Jenis_produk::find( $id )->delete();
        return redirect("admin/jenis_produk");
    }
}
