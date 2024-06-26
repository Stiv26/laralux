@extends("layout.conquer2")
@section("isi")
<td><a class="btn btn-info" href="{{route('produk.create')}}" data-toggle="modal">+ Tambah Produk Baru</a></td><br><br>
<table class = 'table'>
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Nama Hotel</th>
            <th>Tipe Produk</th>
            <th>Harga</th>
            <th>Ubah</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody> 
    @foreach ($data as $item) 
        <tr>
            <td>{{ $item -> nama }}</td>
            <td>{{ $item -> hotel -> nama }}</td>
            <td>{{ $item -> tipeProduk -> nama }}</td>
            <td>{{ $item -> harga }}</td>
            <td><a class="btn btn-warning" href="{{route('produk.edit', $item->id)}}">Ubah</a></td>
            <td>
                <form method="POST" action="{{route('produk.destroy', $item->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="hapus" class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete Product')">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>    
@endsection
@section('judul-halaman', 'Daftar Produk')