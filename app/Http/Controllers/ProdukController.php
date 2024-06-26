<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', ['data' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.formcreate');
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
        $produk = Produk::findOrFail($id);
        $hotel = Hotel::all();
        return view('produk.edit', ["produk" => $produk, "hotel" => $hotel]);
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
        try {
            $produk = Produk::find($id);
            $produk->delete();

            return redirect()->route('produk.index')->with('status', 'Delete Product Successful');
        } catch (\Throwable $th) {

            return redirect()->route('produk.index')->with('status', $th);
        }
    }
}
