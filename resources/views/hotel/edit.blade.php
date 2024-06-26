@extends("layout.conquer2")
@section("isi")
<form action="{{ route('hotel.update', $hotel->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input name="name" type="text" value="{{ $hotel->nama }}" class="form-control" id="exampleInputEmail1"
            aria-describedby="emailHelp" placeholder="Enter Name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Alamat</label>
        <input name="address" value="{{ $hotel->alamat }}" type="text" class="form-control" id="exampleInputEmail1"
            aria-describedby="emailHelp" placeholder="Enter Address">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nomor Telpon</label>
        <input name="city" type="text" value="{{ $hotel->nomortelpon }}" class="form-control" id="exampleInputEmail1"
            aria-describedby="emailHelp" placeholder="Enter City">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Gambar</label>
        <input name="image" type="text" value="{{ $hotel->gambar }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="Masukan URL gambar">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Tipe Hotel</label>
        <select id="" name="type">
            @foreach ($tipe as $item)
                <option @if ($item->id == $item->tipehotel) selected @endif value="{{ $item->id }}">
                    {{ $item->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
@endsection
@section('judul-halaman', 'Ubah Hotel')