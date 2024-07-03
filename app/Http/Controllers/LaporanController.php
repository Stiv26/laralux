<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function topThreeUserTotalTransaction()
    {
        $reports = User::join('transaksi as t', 'users.id', '=', 't.user_id')
                ->select('users.name', DB::raw('sum(t.total) as total_transaksi'))
                ->where('users.role', '=' , 'pembeli')
                ->groupBy('users.name')
                ->orderBy('total_transaksi', 'desc')
                ->limit(3)
                ->get();

        return view('laporan.topMemberTransaction', compact('reports'));
    }

    public function topThreeProductHotelReserved()
    {
        $reports = Hotel::join('produks as p', 'hotels.id', '=', 'p.hotel_id')
                ->join('produk_transaksi as pt', 'p.id', '=', 'pt.produk_id')
                ->select('hotels.nama as hotel_name', 'p.nama as product_name', DB::raw('sum(pt.quantity) as total_reserved'))
                ->groupBy('hotels.nama','p.nama', 'pt.produk_id')
                ->orderBy('total_reserved', 'desc')
                ->limit(3)
                ->get();

        return view('laporan.topReserved', compact('reports'));
    }

    public function topThreeUserAverageTransaction()
    {
        $reports = User::join('transaksi as t', 'users.id', '=', 't.user_id')
                ->select('users.name', DB::raw('avg(t.total) as rata2_transaksi'))
                ->where('users.role', '=' , 'pembeli')
                ->groupBy('users.name')
                ->orderBy('rata2_transaksi', 'desc')
                ->limit(3)
                ->get();

        return view('laporan.avgMemberTransaction', compact('reports'));
    }
}
