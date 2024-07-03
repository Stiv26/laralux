@extends('layout.conquer2')
@section('isi')
    <table class=table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pembeil</th>
                <th>Tanggal Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->user->name }}</td>
                    <td>{{ $d->waktu_transaksi }}</td>
                    <td><a class ="btn btn-default" data-toggle="modal" href="#lihat_{{ $d->id }}">Lihat Rincian
                            Pembelian</a></td>
                    <div class="modal fade" id="lihat_{{ $d->id }}" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type = "button" class = "close" data_dismiss="modal"
                                        aria-hidden="true"></button>
                                    <h4 class="modal-title">Transaction ID #{{ $d->id }} - {{ $d->waktu_transaksi }}
                                    </h4>
                                </div>
                                <div class="modal_body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">
                                                @if ($d->produks)
                                                    @foreach ($d->produks as $p)
                                                        <div class="card mb-4 box-shadow">
                                                            <img class="card-img-top">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ $p->nama }} </h5>
                                                                <p class="card-text">Hotel : {{ $p->hotel->nama }} </p>
                                                                <p class="card-text">Subtotal : {{ $p->pivot->subtotal }}
                                                                </p>
                                                                <p class="card-text">Quantity : {{ $p->pivot->quantity }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <p class="card-text">Total : {{ $d->total }} </p>
                                                <p class="card-text">Total Tanpa Pajak : {{ $d->total_tanpa_pajak }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type = "button" class = "btn btn-default" data_dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('judul-halaman', 'Daftar Transaksi')
