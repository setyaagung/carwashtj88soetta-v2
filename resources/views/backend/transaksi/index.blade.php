@extends('layouts.back-main')

@section('title','Data Transaksi')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                Data Transaksi
                            </h3>
                            <a href="{{ route('transaksi.create')}}" class="btn btn-primary btn-sm float-right">Tambah</a>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('update'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Updated!</strong> {{$message}}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if ($message = Session::get('delete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Deleted!</strong> {{$message}}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>INVOICE</th>
                                        <th>PAKET CUCI</th>
                                        <th>SHIFT</th>
                                        <th>JENIS KENDARAAN</th>
                                        <th>TOTAL</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_transaksi as $transaksi)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->isoFormat('D MMMM Y')}}</td>
                                            <td>{{ $transaksi->no_invoice}}</td>
                                            <td>{{ $transaksi->paket->nama_paket}}</td>
                                            <td>{{ strtoupper($transaksi->shift)}}</td>
                                            <td>{{ $transaksi->kendaraan->jenis_kendaraan}}</td>
                                            <td>Rp. {{ number_format($transaksi->total,0,',','.')}}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
