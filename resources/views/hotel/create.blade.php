@extends("layout.conquer2")
@section("isi")
<form action="{{ route('hotel.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nama">Nama</label>
        <input name="nama" type="text" class="form-control" id="nama"
            placeholder="Masukan nama">
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input name="alamat" type="text" class="form-control" id="alamat"
            placeholder="Masukan alamat">
    </div>
    <div class="form-group">
        <label for="nomortelpon">Nomor Telpon</label>
        <input name="nomortelpon" type="text" class="form-control" id="nomortelpon"
            placeholder="Masukan nomor">
    </div>
    <div class="form-group"> 
        <label for="email">Email</label>
        <input name="email" type="text" class="form-control" id="nomortelpon"
            placeholder="Masukan email">
    </div>
    <div class="form-group">
        <label for="rating">Rating</label> 
        <input name="rating" type="text" class="form-control" id="rating"
            placeholder="Masukan rating">
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input name="gambar" type="text" class="form-control" id="gambar"
            placeholder="Masukan URL gambar"> 
    </div>
    <div class="form-group">
        <label for="tipehotel">Tipe Hotel</label>
        <select id="tipehotel" name="tipehotel" class="form-control">
            @foreach ($tipe as $item)
            <option value="{{ $item->id }}">
                {{ $item->nama }}
            </option>
            @endforeach 
        </select>
          
    </div>
    <br><button type="submit" class="btn btn-primary">+ Tambah</button>
</form>
@endsection
@section('judul-halaman', 'Tambah Hotel')