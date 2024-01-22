<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use illuminate\support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Kartu;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // eloquent
        $pelanggan = Pelanggan::get();
        
        $title = 'Hapus Data Pelanggan!';
        $text = "Apakah Yakin Ingin Menghapus?";
        confirmDelete($title, $text);

        return view("admin.pelanggan.index", ['pelanggan' => $pelanggan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $kartu = DB::table('kartu')->get();
        // $kartu = Kartu::get();
        $gender = ['L', 'P'];
        return view('admin.pelanggan.create', compact('kartu','gender'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // tambah data eloquent
        DB::tabel('pelanggan')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'email' => $request->email,
            'kartu_id' => $request->kartu_id,

        ]);;

        Alert::success('Berhasil!', 'Data Berhasil ditambahkan');

        return redirect('admin/pelanggan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $pelanggan = Pelanggan::find($id);
        // return view ('admin.pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //edit eloquent
        $pelanggan = Pelanggan::all()->where('id',$id);
        $kartu = Kartu::all();
        $gender = ['L','P'];
        return view ('admin.pelanggan.edit', compact('pelanggan', 'kartu','gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 
        $pelanggan = Pelanggan::find($id);
        $pelanggan->kode = $request->kode;
        $pelanggan->nama = $request->nama;
        $pelanggan->jk = $request->jk;
        $pelanggan->tmp_lahir = $request->tmp_lahir;
        $pelanggan->tgl_lahir = $request->tgl_lahir;
        $pelanggan->email = $request->email;
        $pelanggan->kartu_id = $request->kartu_id;
        $pelanggan->save();

        return redirect('admin/pelanggan')->withSuccess('Data Berhasil Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete eloquent
        Pelanggan::find($id)->delete();

        return redirect('admin/pelanggan');
    }
}
