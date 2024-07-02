@extends('layout.conquer2')
@section('isi')

    <table class = 'table'>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Rata - Rata Transaksi (Sesudah Pajak)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->rata2_transaksi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('judul-halaman', 'Top 3 Member dengan Rerata Transaksi Terbanyak')
