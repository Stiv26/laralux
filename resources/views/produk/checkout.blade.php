@extends('layout.conquer2')

@section('isi')
<div class="container">
    <h2>Checkout</h2>
    @if(session('cart'))
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $details)
                    <tr>
                        <td>{{ $details['nama'] }}</td>
                        <td>{{ $details['jumlah'] }}</td>
                        <td>{{ $details['harga'] }}</td>
                        <td>{{ $details['harga'] * $details['jumlah'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <h3>Total Amount: IDR {{ $totalAmount }}</h3>
            <a href="{{ route('cart.placeOrder') }}" class="btn btn-success">Place Order</a>
        </div>
    @else
        <p>Keranjang Anda kosong</p>
    @endif
</div>
@endsection

@section('judul-halaman', 'Checkout')
