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

        if ($usePoints && $user->memberpoint > 0 && $total_tanpa_pajak >= 100000) 
        {
            $pointsToUse = min($user->memberpoint, floor($total_tanpa_pajak / 100000));
            $user->memberpoint -= $pointsToUse;
            $total -= $pointsToUse * 100000;
            $total_tanpa_pajak -= $pointsToUse * 100000;
        }

        $data = new Transaksi();
        $data->user_id = Auth::id();
        $data->waktu_transaksi = now();
        $data->total = $total;
        $data->total_tanpa_pajak = $total_tanpa_pajak;
        $data->save();

        $products = $request->input('products');
        foreach ($products as $product) {
            $data->produks()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'subtotal' => $product['quantity'] * $product['harga'],
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
                $points = 5 * $product['quantity'];
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

    public function checkout()
    {
        // DB::transaction(function () {
        // $cart = session('cart');
        // $user = Auth::user();
        // $t = new Transaction();
        // $t->user_id = $user->id;
        // $t->tanggal_transaksi = Carbon::now()->toDateTimeString();
        // $t->save();
        // $total = $t->insertProducts($cart,$user);
        // $t->total_tanpa_pajak = $total;
        // $t->total = $total + (($total / 100) * 11);
        // $t->save();
        // $user->save();
        // session()->forget('cart');
        // return redirect()->route('laralux.index')->with('status','Checkout berhasil, total adalah Rp.' + $total);
        // });

    }

    // public function checkOut(Request $request)
    // {
    //     $cart = session()->get('cart', []);
    //     $totalPrice = 0;

    //     foreach ($cart as $item) {
    //         $totalPrice += $item['price'] * $item['quantity'];
    //     }

    //     // Cek apakah user memilih untuk menggunakan poin
    //     $usePoints = $request->has('usePoints');
    //     $user = auth()->user(); // Ambil user yang sedang login
    //     $membership = Membership::where('user_id', $user->id)->firstOrFail(); // Sesuaikan dengan struktur tabel Anda

    //     if ($usePoints) {
    //         $pointValue = 100000; // Nilai satu poin
    //         $minimumPurchaseForPoints = 100000; // Minimal pembelian sebelum pajak

    //         if ($totalPrice >= $minimumPurchaseForPoints) {
    //             $pointsToUse = floor($totalPrice / $pointValue);
    //             $pointsToUse = min($pointsToUse, $membership->point);
    //             $membership->point -= $pointsToUse;
    //             $membership->save();
    //             $totalPrice -= ($pointsToUse * $pointValue * 0.11);
    //         }
    //     }

    //     // Simpan data transaksi ke dalam database
    //     $order = new Order();
    //     $order->total = $totalPrice;
    //     $order->tax = $totalPrice * 0.11;
    //     $order->user_id = $user->id;
    //     $order->save();

    //     // Simpan detail produk ke dalam tabel pivot (detail_orders)
    //     foreach ($cart as $item) {
    //         $order->products()->attach($item['id'], [
    //             'quantity' => $item['quantity'],
    //             'subtotal' => $item['price'] * $item['quantity']
    //         ]);

    //         // Hitung poin berdasarkan nama produk dan harga
    //         if (in_array($item['name'], ['Deluxe', 'Superior', 'Suite'])) {
    //             $additionalPoints = 5 * $item['quantity'];
    //             $additionalPoints += floor($item['price'] * $item['quantity'] / 300000);
    //             $membership->point += $additionalPoints;
    //         }
    //     }

    //     $membership->save();

    //     // Setelah selesai, kosongkan session cart
    //     session()->put('cart', []);

    //     // Redirect atau kembali ke view dengan data yang diperlukan
    //     return view('Cart.index')->with('totalPrice', $totalPrice);
    //}



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
