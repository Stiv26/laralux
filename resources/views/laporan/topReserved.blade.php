@extends('layout.conquer2')
@section('isi')

    <table class = 'table'>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Nama Hotel</th>
                <th>Jumlah Kamar yang Pernah Direservasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->hotel_name }}</td>
                    <td>{{ $item->total_reserved }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('judul-halaman', 'Top 3 Produk Hotel dengan Jumlah Reservasi Terbanyak')