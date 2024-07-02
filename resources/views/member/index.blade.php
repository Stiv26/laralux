@extends('layout.conquer2')
@section('isi')

    <td>
        @can('owner-permission', Auth::user())
            <a class="btn btn-info" href="{{ route('member.create') }}" data-toggle="modal">+ Tambah Member Baru</a>
        </td><br><br>
    @endcan

    <table class = 'table'>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Poin Member</th>
                @can('owner-permission', Auth::user())
                    <th>Ubah</th>
                    <th>Hapus</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->memberpoint }}</td>
                        @can('owner-permission', Auth::user())
                        <td><a class="btn btn-warning" href="{{ route('member.edit', $item->id) }}">Ubah</a></td>
                        <td>
                            <form method="POST" action="{{ route('member.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="hapus" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete member')">
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('judul-halaman', 'Daftar Member')
