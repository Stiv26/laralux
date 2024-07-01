@extends("layout.conquer2")
@section("isi")
<form action="{{ route('produk.update', $produk->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama">Nama produk</label>
        <input name="nama" type="text" class="form-control" id="nama" value="{{ $produk->nama }}" placeholder="Masukan nama">
    </div>
    <div class="form-group">
        <label for="hotel">Nama hotel</label>
        <select id="hotel" name="hotel" class="form-control">
            @foreach ($hotel as $item)
                <option value="{{ $item->id }}" {{ $item->id == $produk->hotel_id ? 'selected' : '' }}>{{ $item->nama }}</option>
            @endforeach 
        </select>
    </div>
    <div class="form-group">
        <label for="tipeproduk">Tipe produk</label>
        <select id="tipeproduk" name="tipeproduk" class="form-control">
            @foreach ($tipe as $item)
                <option value="{{ $item->id }}" {{ $item->id == $produk->prodtipe_id ? 'selected' : '' }}>{{ $item->nama }}</option>
            @endforeach 
        </select>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input name="harga" type="text" class="form-control" id="harga" value="{{ $produk->harga }}" placeholder="Masukan harga">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Update Produk</button>
</form>
@endsection
@section('judul-halaman', 'Ubah Produk')