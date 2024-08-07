<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;


class FrontEndController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('frontend.index', compact('produk')); 
    }
 
    public function show($id)
    {
        $produk = Produk::find($id);
        return view('frontend.product-detail', compact('produk'));
    }

    public function addToCart($id)
    {
        $produk = Produk::find($id);
        $cart = session()->get('cart');
        
        if(!isset($cart[$id]))
        {
            $cart[$id] = [
            'id' => $id,
            'nama' => $produk->nama,
            'produk_id' => $produk->id,
            'jumlah' => 1,
            'harga' => $produk->harga,
            'gambar' => $produk->gambar,
            ];
        }
        else{
            $cart[$id]['jumlah']++;
        }
        session()->put('cart',$cart);
        return redirect()->back()->with("status","Produk Telah ditambahkan ke Cart");
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function addQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        $product = Produk::find($cart[$id]['id']);
        if(isset($cart[$id]))
        {
            $jumlahAwal = $cart[$id]['quantity'];
            $jumlahPesan = $jumlahAwal+1;
            if($jumlahPesan < $product->available_room)
            { 
                $cart[$id]['quantity']++;
            }
            else{
                return redirect()->back()->with('error','Jumlah pemesanan melebihi total kamar yang tersedia');
            }
        }
        session()->forget('cart');
        session()->put('cart',$cart);
    }

    public function reduceQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if(isset($cart[$id]))
        {
            if($cart[$id]['quantity'] > 0)
            {
                $cart[$id]['quantity']--;
            }
        }
        session()->forget('cart');
        session()->put('cart',$cart);
    }

    public function deleteFromCart($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id]))
        {
            unset($cart[$id]);
        }
        session()->forget('cart');
        session()->put('cart',$cart);
        return redirect()->back()->with("status","Produk Telah dibuang dari Cart");
    }
}
