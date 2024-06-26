<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\TipeHotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index() 
    {
        $hotel = Hotel::all();
        return view('hotel.index', ['data' => $hotel]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = TipeHotel::all();
        return view('hotel.create', ["tipe" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomortelpon' => 'required',
            'email' => 'required',
            'rating' => 'required',
            'gambar' => 'required',
            'tipehotel' => 'required'
        ]);
    
        $newHotel = new Hotel;
        $newHotel->nama = $request->nama;
        $newHotel->alamat = $request->alamat;
        $newHotel->nomortelpon = $request->nomortelpon;
        $newHotel->email = $request->email;
        $newHotel->rating = $request->rating;
        $newHotel->gambar = $request->gambar;
        $newHotel->hoteltipe_id = $request->tipehotel;
    
        $newHotel->save();
    
        return redirect()->route('hotel.index')->with('status', 'Hotel Successfully Created');
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
        $hotel = Hotel::findOrFail($id);
        $tipe = TipeHotel::all();
        return view('hotel.edit', ["hotel" => $hotel, "tipe" => $tipe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomortelpon' => 'required',
            'email' => 'required',
            'rating' => 'required',
            'gambar' => 'required',
            'tipehotel' => 'required'
        ]);
    
        $editHotel = Hotel::findOrFail($id);
        $editHotel->nama = $request->nama;
        $editHotel->alamat = $request->alamat;
        $editHotel->nomortelpon = $request->nomortelpon;
        $editHotel->email = $request->email;
        $editHotel->rating = $request->rating;
        $editHotel->gambar = $request->gambar;
        $editHotel->hoteltipe_id = $request->tipehotel;
        
        $editHotel->save();
        return redirect()->route('hotel.index')->with('status', 'Hotel Successfully Updated');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = Hotel::find($id);

        if ($hotel) {
            foreach ($hotel->produks as $produk) {
                $produk->delete();
            }
    
            $hotel->delete();
            return redirect()->route('hotel.index')->with('status', 'Delete Hotel Successful');
        }
    
        return redirect()->route('hotel.index')->with('status', 'Hotel Not Found');
    }
}
