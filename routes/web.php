<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LihatNilaiController;

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\NotFoundController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BerandaController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ShopController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ShopController::class, 'remove'])->name('remove.from.cart');

Route::get('/produkAPI', [ProdukController::class, 'apiProduk']);
Route::get('/produkAPI/{id}', [ProdukController::class, 'apiProdukDetail']);

Route::get('/salam', function () {
    return "Selamat Pagi! Selamat Belajar Laravel";
});

// tambah routing

Route::get("/staff/{nama}/{devisi}", function ($nama, $devisi) {
    return 'Nama Pegawai : ' . $nama . '<br> Departemen : ' . $devisi;
});

// routing dengan memanggil nama file dari view
Route::get('/kondisi', function () {
    return view('kondisi');
});

Route::get('/nilai', function () {
    return view('coba.nilai');
});

// routing dengan view dan array data
Route::get('daftarnilai', function () {
    return view('coba.daftar');
});

// routing memanggil dari class controller
Route::get('/datamahasiswa',[LihatNilaiController::class, 'dataMahasiswa']);



Route::group(['middleware' => ['auth', 'peran:admin-manager-staff']], function(){
    
    // grouping
    Route::prefix('admin')->group(function () {
        // memanggil secara satu persatu function menggunakan get, pull, update, delate
        Route::get('/dashboard',[DashboardController::class, 'index']);
        Route::get('/404',[NotFoundController::class, 'index']);
        
        // memanggil seluruh fungsi atau function
        Route::resource('kartu', KartuController::class);
        Route::resource('pelanggan', PelangganController::class);
        
        // memanggil fungsi satu persatu
        Route::get('/jenis_produk', [JenisProdukController::class, 'index']);
        Route::get('/produk', [ProdukController::class,'index']);
        
        // create table jenis produk
        Route::get('/jenis_produk/create', [JenisProdukController::class,'create']);
        Route::post('/jenis_produk/store', [JenisProdukController::class,'store']);
        Route::get('/jenis_produk/show/{id}', [JenisProdukController::class,'show']);
        Route::get('/jenis_produk/edit/{id}', [JenisProdukController::class,'edit']);
        Route::post('/jenis_produk/update/{id}', [JenisProdukController::class,'update']);
        Route::get('/jenis_produk/delete/{id}', [JenisProdukController::class,'destroy']);
        
        // create table produk
        Route::get('/produk/create', [ProdukController::class,'create']);
        Route::post('/produk/store', [ProdukController::class,'store']);
        
        // detail, edit, update table produk
        Route::get('/produk/show/{id}', [ProdukController::class,'show']);
        Route::get('/produk/edit/{id}', [ProdukController::class,'edit']);
        Route::post('/produk/update/{id}', [ProdukController::class,'update']);
        Route::get('/produk/delete/{id}', [ProdukController::class,'destroy']);
        
        // PDF
        Route::get('/generatePDF', [ProdukController::class,'generatePDF']);
        Route::get('/produk/produkPDF', [ProdukController::class,'produkPDF']);
        Route::get('/produk/PDFshow/{id}', [ProdukController::class,'produkPDF_detail']);

        // Excel
        Route::get('/produk/exportExcel', [ProdukController::class, 'exportProduk']);
        Route::post('/produk/import', [ProdukController::class,'importProduk']);

        // profile user
        Route::get('/user', [UserController::class, 'index']);
        Route::get('/profile', [UserController::class, 'show']);
        Route::patch('/profile/{id}', [UserController::class, 'update']);

    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
