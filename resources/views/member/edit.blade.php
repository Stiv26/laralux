@extends("layout.conquer2")
@section("isi")
<form action="{{ route('member.update', $member->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama">Nama</label>
        <input name="nama" type="text" value="{{ $member->name }}" class="form-control" id="nama"
            placeholder="Masukkan Nama">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input name="email" value="{{ $member->email }}" type="text" class="form-control" id="email"
            placeholder="Masukkan Email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input name="password"  type="password" class="form-control" id="password"
            placeholder="Masukkan Password Baru">
    </div>
    <br><button type="submit" class="btn btn-primary">Ubah</button>
</form>
@endsection
@section('judul-halaman', 'Ubah Member')
