@extends('layout.conquer2')

@section('isi')
<div class="container">
    <h2>Keranjang Belanja</h2>
    @if(session('cart'))
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Hapus Belanja</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $details)
                    <tr>
                        <td>{{ $details['nama'] }}</td>
                        <td>{{ $details['harga'] }}</td>
                        <td>
                            <form action="{{ route('cart.addQty') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-success">+</button>
                            </form>

                            {{ $details['jumlah'] }}

                            <form action="{{ route('cart.reduceQty') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-warning">-</button>
                            </form>
                        </td>
                        <td>{{ $details['harga'] * $details['jumlah'] }}</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Checkout</a>
        </div>
    @else
        <p>Keranjang Anda kosong</p>
    @endif
</div>
@endsection

@section('judul-halaman', 'Keranjang Belanja')

