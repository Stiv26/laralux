@extends("layout.conquer2")
@section("isi")
<table class = 'table'>
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Nama Hotel</th>
            <th>Tipe Produk</th>
            <th>Harga</th>
        </tr>
    </thead>    
    @foreach ($data as $item)
    <tr>
        <td>{{ $item -> nama }}</td>
        <td>{{ $item -> hotel -> nama }}</td>
        <td>{{ $item -> tipeProduk -> nama }}</td>
        <td>{{ $item -> harga }}</td>
    </tr>
</table>    
@endsection
@section('judul-halaman', 'Daftar Produk')