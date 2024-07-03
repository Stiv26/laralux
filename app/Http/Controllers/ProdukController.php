<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Produk;
use App\Models\TipeProduk;
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
        $tipe = TipeProduk::all();
        $hotel = Hotel::all();
        return view('produk.create', ["tipe" => $tipe, "hotel" => $hotel]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'hotel' => 'required', // Update ini sesuai dengan nama field pada form
            'tipeproduk' => 'required', // Update ini sesuai dengan nama field pada form
            'harga' => 'required'
        ]);
    
        $newproduk = new Produk;
        $newproduk->nama = $request->nama;
        $newproduk->hotel_id = $request->hotel; // Update ini sesuai dengan nama field pada form
        $newproduk->prodtipe_id = $request->tipeproduk; // Update ini sesuai dengan nama field pada form
        $newproduk->harga = $request->harga;
    
        $newproduk->save();
    
        return redirect()->route('produk.index')->with('status', 'Produk Successfully Created');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $hotel = Hotel::all();
        $tipe = TipeProduk::all();
        return view('produk.edit', ["produk" => $produk, "hotel" => $hotel, "tipe" => $tipe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'hotel' => 'required',
            'tipeproduk' => 'required',
            'harga' => 'required'
        ]);

        $editproduk = Produk::findOrFail($id);
        $editproduk->nama = $request->nama;
        $editproduk->hotel_id = $request->hotel;
        $editproduk->prodtipe_id = $request->tipeproduk; // Sesuaikan dengan nama kolom di database
        $editproduk->harga = $request->harga;

        $editproduk->save();

        return redirect()->route('produk.index')->with('status', 'Produk Successfully Updated');
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

    public function cart()
    {
        return view('produk.cart');
    }

    public function addToCart($id)
    {
        $produk = Produk::find($id);
        $cart = session()->get('cart');
        
        if (!isset($cart[$id])) {
            $cart[$id] = [
                'id' => $id,
                'nama' => $produk->nama,
                'jumlah' => 1,
                'harga' => $produk->harga,
                'gambar' => $produk->gambar,
            ];
        } else {
            $cart[$id]['jumlah']++;
        }

        session()->put('cart', $cart);
        return redirect()->back()->with("status", "Produk Telah ditambahkan ke Cart");
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with("status", "Produk telah dihapus dari keranjang");
    }

    public function addQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);
        $product = Produk::find($id);

        if (isset($cart[$id])) {
                $cart[$id]['jumlah']++;
                session()->put('cart', $cart);
                return redirect()->route('cart')->with('status', 'Jumlah produk ditambah');
        }

        return redirect()->route('cart')->with('status', 'Produk tidak ditemukan di keranjang');
    }

    public function reduceQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id]) && $cart[$id]['jumlah'] > 1) {
            $cart[$id]['jumlah']--;
            session()->put('cart', $cart);
            return redirect()->route('cart')->with('status', 'Jumlah produk dikurangi');
        }

        return redirect()->route('cart')->with('status', 'Produk tidak ditemukan di keranjang atau jumlah sudah 1');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        // Calculate total amount
        $totalAmount = 0;
        $totalAmountWithTax = 0;
        foreach ($cart as $details) {
            $totalAmount += $details['harga'] * $details['jumlah'];
            $totalAmountWithTax += $details['harga'] * $details['jumlah'] + 11 / 100 * $details['harga'] * $details['jumlah'];
        }
    
        return view('produk.checkout', compact('cart', 'totalAmount', 'totalAmountWithTax'));
    }

    // Method to handle order placement
    public function placeOrder()
    {
        $cart = session()->get('cart', []);
        
        session()->forget('cart');
        
        return redirect()->route('produk.index')->with('status', 'Order placed successfully!');
    }

}
