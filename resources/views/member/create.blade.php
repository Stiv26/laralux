@extends("layout.conquer2")
@section("isi")
<form action="{{ route('member.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nama">Nama</label>
        <input name="nama" type="text" class="form-control" id="nama"
            placeholder="Masukan nama">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input name="email" type="text" class="form-control" id="alamat"
            placeholder="Masukan Email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="text" class="form-control" id="nomortelpon"
            placeholder="Masukan Password">
    </div>
    <br><button type="submit" class="btn btn-primary">+ Tambah</button>
</form>
@endsection
@section('judul-halaman', 'Tambah Member')