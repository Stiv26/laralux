@extends("layout.conquer2")
@section("isi")
@can('owner-permission', Auth::user())
<th>
    <td><a class="btn btn-info" href="{{ route('produk.create') }}" data-toggle="modal">+ Tambah Produk Baru</a></td>
    @endcan
    <td>
        <a href="{{ route('cart') }}" class="btn btn-info">
            <i class="fa fa-shopping-cart"></i>
            <span>
                @if (session('cart'))
                    {{ '(' . count(session('cart')) . ')' }}
                @else
                    (0)
                @endif
            </span>
        </a>
        My Point: {{ Auth::user() -> memberpoint }}
    </td><br><br>
</th>

<table class='table'>
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Nama Hotel</th>
            <th>Tipe Produk</th>
            <th>Harga</th>
            @can('owner-permission', Auth::user())
                <th>Ubah</th>
                <th>Hapus</th>
            @endcan
            @can('pembeli-permission', Auth::user())
            <th>Transaksi</th>
            @endcan
        </tr>
    </thead>
    <tbody> 
    @foreach ($data as $item) 
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->hotel->nama }}</td>
            <td>{{ $item->tipeProduk->nama }}</td>
            <td>{{ $item->harga }}</td>
            @can('owner-permission', Auth::user())
                <td><a class="btn btn-warning" href="{{ route('produk.edit', $item->id) }}">Ubah</a></td>
                <td>
                    <form method="POST" action="{{ route('produk.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="hapus" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete Product?')">
                    </form>
                </td>
            @endcan
            @can('pembeli-permission', Auth::user())
                <td><a class="btn" href="{{ route('produk.addCart', $item->id) }}"><i class="fa fa-shopping-cart"></i> Tambahkan ke Keranjang</a></td>
            @endcan
            </tr>
    @endforeach
    </tbody>
</table>    
@endsection

@section('judul-halaman', 'Daftar Produk')
