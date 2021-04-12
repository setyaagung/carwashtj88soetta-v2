@extends('layouts.back-main')

@section('title')
    Informasi Absensi, Gaji dan Bon {{ $karyawan->nama_karyawan}}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">
                                        Absensi {{ $karyawan->nama_karyawan}}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>TANGGAL</th>
                                                <th>SHIFT</th>
                                                <th>PENDAPATAN</th>
                                                <th>KETERANGAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">
                                        Bon {{ $karyawan->nama_karyawan}}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>TANGGAL</th>
                                                <th>JUMLAH</th>
                                                <th>KETERANGAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_bon as $bon)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($bon->tanggal_bon)->isoFormat('D MMMM Y')}}</td>
                                                    <td>Rp. {{ number_format($bon->jumlah,0,',','.')}}</td>
                                                    <td>{{ $bon->keterangan}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
