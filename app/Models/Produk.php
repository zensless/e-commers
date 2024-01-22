<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    public $timestamps = false;
    protected $fillable = [
        'kode', 'nama', 'harga_beli', 'harga_jual', 'stok', 'min_stok', 'foto', 'deskripsi', 'jenis_produk_id'
        ] ;

    // relasi one to many ke table yang berhubungan dengan produk
    public function jenis_produk() {
        return $this->belongsTo(Jenis_produk::class);
    }

    // relasi one to one
    // public function gaji() {
    //     return $this->hasOne(Gaji::class);
    // }
}
