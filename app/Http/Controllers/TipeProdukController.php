<?php

namespace App\Http\Controllers;

use App\Models\TipeProduk;
use Illuminate\Http\Request;

class TipeProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipeproduk = TipeProduk::all();
        return view('tipeproduk.index', ['data' => $tipeproduk]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotel.formcreate');
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
