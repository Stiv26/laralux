<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

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
        DB::transaction(function () {
        $cart = session('cart');
        $user = Auth::user();
        $t = new Transaction();
        $t->user_id = $user->id;
        $t->tanggal_transaksi = Carbon::now()->toDateTimeString();
        $t->save();
        $total = $t->insertProducts($cart,$user);
        $t->total_tanpa_pajak = $total;
        $t->total = $total + (($total / 100) * 11);
        $t->save();
        $user->save();
        session()->forget('cart');
        return redirect()->route('laralux.index')->with('status','Checkout berhasil, total adalah Rp.' + $total);
        });
    }


    public function insertProducts($cart,$user)
    {
        $total = 0;
        foreach ($cart as $c) 
        {
            if($c->name == "deluxe" || $c->name == "superior" || $c->name == "suite"){
                $user->memberpoint += 5;
            }
            $subtotal = $c['quantity'] * $c['price'];
            $total += $subtotal;
            if($total >= 300000){
                $modtotal = $total;
                while ($modtotal >= 300000);
                $user->memberpoint += 1;
            }
            $this->products()->attach($c['id'],['quantity' => $c['quantity'], 'subtotal' => $subtotal]);
        }
        
        return $total;
    }
}
