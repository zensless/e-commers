<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kartu;

// use DB digunakan sebagai syarat ketika membuat sintaks query builder
// use DB;
use Illuminate\Support\Facades\DB;

class KartuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // sintaks menggunakan query builder
        $kartu = DB::table('kartu')->get();
        return view('admin.kartu.index', compact('kartu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
