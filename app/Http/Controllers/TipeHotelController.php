<?php

namespace App\Http\Controllers;

use App\Models\TipeHotel;
use Illuminate\Http\Request;

class TipeHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipehotel = TipeHotel::all();
        return view('tipehotel.index', ['data' => $tipehotel]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipehotel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);
    
        $newtipemodel = new TipeHotel;
        $newtipemodel->nama = $request->nama;
        
        $newtipemodel->save();

        return redirect()->route('tipemodel.index')->with('status', 'Tipe Hotel Successfully Created');
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
