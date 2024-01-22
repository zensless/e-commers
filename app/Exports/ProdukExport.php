<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProdukExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // return Produk::all();
        $produk = Produk::join('jenis_produk', 'jenis_produk_id', '=', 'jenis_produk.id')
        ->select('produk.kode', 'produk.nama', 'produk.harga_beli', 'produk.harga_jual', 'produk.stok', 'produk.min_stok', 
        'jenis_produk.nama AS jenis')
        ->get();
        return $produk;
    }
    public function headings(): array 
    {
        return [
            'kode',
            'nama',
            'harga beli',
            'harga jual',
            'stok',
            'min stok',
            'jenis',
        ];
    }
}
