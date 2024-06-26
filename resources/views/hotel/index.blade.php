@extends("layout.conquer2")
@section("isi")
<table class = 'table'>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Tipe Hotel</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item -> nama }}</td>
            <td>{{ $item -> alamat }}</td>
            <td>{{ $item -> nomortelpon }}</td>
            <td>{{ $item -> email }}</td>
            <td>{{ $item -> rating }}</td>
            <td>{{ $item -> tipeHotel -> nama }}</td>
        </tr>
        @endforeach
    </tbody>
</table>    
@endsection
@section('judul-halaman', 'Daftar Hotel')