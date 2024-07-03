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
            <th>Lihat Detail</th>
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
            <td>
                <a class="btn btn-success" data-toggle="modal" href="#lihat-{{ $item->id }}">Lihat Detail</a>
                <div class="modal fade" id="lihat-{{ $item->id }}" tabindex="-1" role="basic"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true"></button>
                                <h4 class="modal-title">Lihat Hotel</h4>
                            </div>
                            <div class="modal-body">
                                <img src="{{ $item->hotel->gambar }}" alt="" style="width:90%;">
                                <p class="card-text">Hotel : {{ $item->hotel->nama }} </p>
                                <p class="card-text">Alamat : {{ $item->hotel->alamat }}</p>
                                <p class="card-text">Rating : {{ $item->hotel->rating }}</p>
                                <p class="card-text">Tipe : {{ $item->tipeproduk->nama }}</p>
                                <p class="card-text">Harga : {{ $item->harga }}</p>
                                <p class="card-text">Email : {{ $item->hotel->email }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
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
