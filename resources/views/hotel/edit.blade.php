@extends("layout.conquer2")
@section("isi")
<form action="{{ route('hotel.update', $hotel->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama">Nama</label>
        <input name="nama" type="text" value="{{ $hotel->nama }}" class="form-control" id="nama"
            placeholder="Enter Name">
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input name="alamat" value="{{ $hotel->alamat }}" type="text" class="form-control" id="alamat"
            placeholder="Enter Address">
    </div>
    <div class="form-group">
        <label for="nomortelpon">Nomor Telpon</label>
        <input name="nomortelpon" type="text" value="{{ $hotel->nomortelpon }}" class="form-control" id="nomortelpon"
            placeholder="Enter City">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input name="email" value="{{ $hotel->email }}" type="text" class="form-control" id="email"
            placeholder="Enter Email">
    </div>
    <div class="form-group">
        <label for="rating">Rating</label>
        <input name="rating" type="text" value="{{ $hotel->rating }}" class="form-control" id="rating"
            placeholder="Enter Rating">
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input name="gambar" type="text" value="{{ $hotel->gambar }}" class="form-control" id="gambar"
            placeholder="Masukan URL gambar">
    </div>
    <div class="form-group">
        <label for="tipehotel">Tipe Hotel</label>
        <select id="tipehotel" name="tipehotel" class="form-control">
            @foreach ($tipe as $item)
                <option value="{{ $item->id }}" @if ($item->id == $hotel->tipehotel->id) selected @endif>
                    {{ $item->nama }}
                </option>
            @endforeach
        </select>        
    </div>
    <br><button type="submit" class="btn btn-primary">Ubah</button>
</form>
@endsection
@section('judul-halaman', 'Ubah Hotel')