<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotFoundController extends Controller
{
   // fungsi index
   public function index() {
    return view("admin.NotFound"); // mengarahkan ke file dashboard yang ada di dalam admin
}
}
