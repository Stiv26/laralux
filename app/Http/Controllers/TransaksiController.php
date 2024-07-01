<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function checkout()
    {
        $cart = session('cart');
        $user = Auth::user();
        $t = new Transaction();
        $t->user_id = $user->id;
        $t->customer_id = 1;
        $t->tanggal_transaksi = Carbon::now()->toDateTimeString();
        $t->save();

        $t->insertProducts($cart,$user);
        session()->forget('cart');
        return redirect()->route('laralux.index')->with('status','Checkout berhasil');
    }

    public function insertProducts($cart,$user)
    {
        $total = 0;
        foreach ($cart as $c) 
        {
            $subtotal = $c['quantity']* $c['price'];
            $total += $subtotal;
            $this->products()->attach($c['id'],['quantity' => $c['quantity'], 'subtotal' => $subtotal]);
        }
    }
}
