<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Jenis_produk;

use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ProdukExport;
use App\Imports\ProdukImport;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // produk berelasi dengan jenis_produk
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama AS jenis')
        ->get();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // tambah data
        $jenis_produk = DB::table('jenis_produk')->get();
        return view('admin.produk.create', compact('jenis_produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode'=> 'required | max:10 | unique:produk',
            'nama'=> 'required | max:45',
            'harga_beli'=> 'required | numeric',
            'harga_jual'=> 'required | numeric',
            'stok'=> 'required | numeric',
            'min_stok'=> 'required | numeric',
            'foto'=> 'nullable | image | mimes:jpg,jpeg,gif,png,svg | max:2048',
            'deskripsi'=> 'nullable | string | min:10',
            'jenis_produk_id'=> 'required | integer',
        ],
        [
            'kode.required' => 'Kode Wajib diisi',
            'kode.max' => 'Kode Maksimal 10 Karakter',
            'kode.unique' => 'Kode Harus Berbeda',
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama Maksimal 45 Karakter',
            'harga_beli.required' => 'Harga Beli Wajib Diisi',
            'harga_beli.numeric' => 'Harus Angka',
            'harga_jual.required' => 'Harga Jual Wajib Diisi',
            'harga_jual.numeric' => 'Harus Angka',
            'stok.required' => 'Stok Wajib Diisi',
            'min_stok.required' => 'Minimal Stok Wajib Terisi',
            'foto.max' => 'Maksimal 2 MB',
            'foto.image' => 'File ekstensi harus jpg, jpeg, gif, png, svg',
            'deskripsi.min' => 'Minimal 10 Karakter',
        ]
        );

        // proses upload foto
        if(!empty($request->foto)) {
            $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
            $request->foto->move(public_path('admin/img'), $fileName);
        } else {
            $fileName = '';
        }
        // tambah data menggunakan query builder
        DB::table('produk')->insert([
            'kode'=> $request->input('kode'),
            'nama'=> $request->input('nama'),
            'harga_beli'=> $request->input('harga_beli'),
            'harga_jual'=> $request->input('harga_jual'),
            'stok'=> $request->input('stok'),
            'min_stok'=> $request->input('min_stok'),
            'foto' => $fileName,
            'deskripsi'=> $request->input('deskripsi'),
            'jenis_produk_id'=> $request->input('jenis_produk_id'),
        ]);
        // Alert::success('Berhasil Ditambahkan!', 'Data Berhasil ditambahkan');
        return redirect('admin/produk')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama AS jenis')
        ->where('produk.id', $id)
        ->get();
        return view('admin.produk.detail', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 
        $jenis_produk = DB::table('jenis_produk')->get();
        $produk = DB::table('produk')->where('id', $id)->get();
        return view('admin.produk.edit', compact('jenis_produk', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode'=> 'required',
            'nama'=> 'required',
            'harga_beli'=> 'required',
            'harga_jual'=> 'required',
            'stok'=> 'required',
            'min_stok'=> 'required',
            'foto'=> 'nullable | image | mimes:jpg,jpeg,gif,png,svg | max:2048',
            'jenis_produk_id'=> 'required',
        ],
        [
            'kode.required' => 'Kode Wajib diisi',
            'nama.required' => 'Nama Wajib Diisi',
            'harga_beli.required' => 'Harga Beli Wajib Diisi',
            'harga_jual.required' => 'Harga Jual Wajib Diisi',
            'stok.required' => 'Stok Wajib Diisi',
            'min_stok.required' => 'Minimal Stok Wajib Terisi',
            'foto.max' => 'Maksimal 2 MB',
            'foto.image' => 'File ekstensi harus jpg, jpeg, gif, png, svg',
        ]
        );

        // update foto
        $produk = DB::table('produk')->select('foto')->where('id', $id)->first();
        
        // dd ($produk)
        $namaFileFotoLama = $produk->foto;

        if (!empty($request->foto)) {

            // Jika ada foto lama maka dihapus fotonya
            if(!empty($fileName)) unlink('admin/img'.$namaFileFotoLama);

            $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
            $request->foto->move(public_path('admin/img'), $fileName);

        } else {
            $fileName = '';
        }

        DB::table('produk')->where('id',$request->id)->update([
            'kode'=> $request->input('kode'),
            'nama'=> $request->input('nama'),
            'harga_beli'=> $request->input('harga_beli'),
            'harga_jual'=> $request->input('harga_jual'),
            'stok'=> $request->input('stok'),
            'min_stok'=> $request->input('min_stok'),
            'foto' => $fileName,
            'deskripsi'=> $request->input('deskripsi'),
            'jenis_produk_id'=> $request->input('jenis_produk_id'),
        ]);
        // Alert::success('Berhasil!', 'Data Berhasil diubah');
        return redirect('admin/produk')->with('success','Data Berhasil Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 
        DB::table('produk')->where('id',$id)->delete();
        Alert::error('Berhasil Dihapus!', 'Data Berhasil dihapus');
        return redirect('admin/produk')->withSuccess('Berhasil Dihapus');
    }

    public function generatePDF() {
        $data = [
            'title'=> 'Welcome to export PDF',
            'data'=> ('m/d/y'),
        ];
        $pdf = PDF::loadView('admin.produk.myPDF', $data);
        return $pdf->download('test.pdf');
    }

    public function produkPDF() {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama AS jenis')
        ->get();

        $pdf = PDF::loadView('admin.produk.produkPDF', ['produk'=>$produk])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function produkPDF_detail(string $id) {
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.*', 'jenis_produk.nama AS jenis')
        ->where('produk.id', $id)
        ->get();

        $pdf = PDF::loadView('admin.produk.produkPDF_show', ['produk'=>$produk]);

        return $pdf->stream();
    }

    public function exportProduk() 
    {
        $fileName = 'produk '. time() .'.xlsx';
        return Excel::download(new ProdukExport, $fileName);
    }

    public function importProduk($request) 
    {
        // $file = $request->file('file');
        // $filename = $file->getClientOriginalName();
        // $file->move('file_excel', $filename);
        // Excel::import(new ProdukImport, public_path('file_excel'), $filename);
        Excel::import(new ProdukImport, $request->file('file')->store('temp'));
        
        return redirect('admin/produk')->with('success', 'Data Produk Berhasil diimport!');
    }

    public function apiProduk() {
        $produk = Produk::all();
        return response()->json([
            'success'=>true,
            'massege'=>'Data Produk',
            'data'=>$produk
        ],200);
    }

    public function apiProdukDetail($id) {
        $produk = Produk::find($id);
        if ($produk) {
            return response()->json([
                'success'=>true,
                'massege'=>'Detail Produk',
                'data'=>$produk
            ],200);
        }
        else {
            return response()->json([
                'success'=>false,
                'massege'=>'Detail Produk Tidak Ditemukan'
            ],404);
        }
    }
}
