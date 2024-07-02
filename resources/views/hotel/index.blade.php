@extends('layout.conquer2')
@section('isi')

    <td>
    @can('owner-permission', Auth::user())
        <a class="btn btn-info" href="{{ route('hotel.create') }}" data-toggle="modal">+ Tambah Hotel Baru</a>
    </td><br><br>
    @endcan

    <table class = 'table'>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Rating</th>
                <th>Tipe Hotel</th>
                <th>Gambar</th>
                @can('owner-permission', Auth::user())
                    <th>Ubah</th>
                    <th>Hapus</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->nomortelpon }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->rating }}</td>
                    <td>{{ $item->tipeHotel->nama }}</td>
                    <td>
                        <a class="btn btn-success" data-toggle="modal" href="#lihat-{{ $item->id }}">Lihat Gambar</a>
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
                                        <img src="{{ $item->gambar }}" alt="" style="width:90%;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('owner-permission', Auth::user())
                        <td><a class="btn btn-warning" href="{{ route('hotel.edit', $item->id) }}">Ubah</a></td>
                        <td>
                            <form method="POST" action="{{ route('hotel.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="hapus" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete Hotel')">
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('judul-halaman', 'Daftar Hotel')
