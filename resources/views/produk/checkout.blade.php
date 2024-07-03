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
                    <th>Total (tanpa pajak 11%)</th>
                </tr>
            </thead>
            <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <tbody>
                @foreach($cart as $id => $details)
                    <tr>
                        <td>{{ $details['nama'] }}</td>
                        <td>{{ $details['jumlah'] }}</td>
                        <td>{{ $details['harga'] }}</td>
                        <td>{{ $details['harga'] * $details['jumlah'] * 1.11 }}</td>
                        <td>{{ $details['harga'] * $details['jumlah'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <h3>Total Amount: IDR {{ $totalAmount }}</h3>
            <h3>Total Amount with TAX: IDR {{ $totalAmountWithTax }}</h3>
                <input type="hidden" name="total" value="{{ $totalAmountWithTax }}">
                <input type="hidden" name="total_tanpa_pajak" value="{{ $totalAmount }}">
                <br>
                <button type="submit" class="btn btn-success">Place Order</button>
            </div>
        </form>
    @else
        <p>Keranjang Anda kosong</p>
    @endif
</div>
@endsection

@section('judul-halaman', 'Checkout')
