<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('transaksi.index', ['data' => $transaksi]);
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
        $request->validate([
            'total' => 'required|numeric',
            'total_tanpa_pajak' => 'required|numeric',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:produks,id',
            'products.*.type' => 'required|string',
            'products.*.harga' => 'required|numeric',
            'products.*.price' => 'required|numeric',
        ]);

        $user = Auth::user();
        $total = $request->input('total');
        $total_tanpa_pajak = $request->input('total_tanpa_pajak');
        $usePoints = $request->input('use_points', false);

        if ($usePoints && $user->memberpoint > 0 && $total_tanpa_pajak >= 100000) {
            $pointsToUse = min($user->memberpoint, floor($total_tanpa_pajak / 100000));
            $user->memberpoint -= $pointsToUse;
            $total -= $pointsToUse * 100000;
            $total_tanpa_pajak -= $pointsToUse * 100000;
        }

        $data = new Transaksi();
        $data->user_id = Auth::id();
        $data->user_id = $user->id;
        $data->waktu_transaksi = now();
        $data->total = $total;
        $data->total_tanpa_pajak = $total_tanpa_pajak;
        $data->save();

        $products = $request->input('products');
        foreach ($products as $product) {
            $data->produks()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'subtotal' => $product['quantity'] * $product['harga'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->updateMemberPoints($user, $products);

        return redirect()->route('produk.index')->with('status', 'Transaksi Berhasil');
    }

    private function updateMemberPoints(User $user, array $products)
    {
        $points = 0;

        foreach ($products as $product) {
            if (in_array($product['type'], ['deluxe', 'superior', 'suite'])) {
                $points += 5 * $product['quantity'];
            } else {
                $points += floor(($product['price'] * $product['quantity']) / 300000);
            }
        }

        $user->memberpoint += $points;
        $user->save();
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


    public function insertProducts($cart, $user)
    {
        $total = 0;
        foreach ($cart as $c) {
            if ($c->name == "deluxe" || $c->name == "superior" || $c->name == "suite") {
                $user->memberpoint += 5;
            }
            $subtotal = $c['quantity'] * $c['price'];
            $total += $subtotal;
            if ($total >= 300000) {
                $modtotal = $total;
                while ($modtotal >= 300000);
                $user->memberpoint += 1;
            }
            $this->products()->attach($c['id'], ['quantity' => $c['quantity'], 'subtotal' => $subtotal]);
        }

        return $total;
    }
}
