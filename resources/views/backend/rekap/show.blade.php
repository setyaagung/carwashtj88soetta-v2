@extends('layouts.back-main')

@section('title','Data Rekap')

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
                                DETAIL REKAP SHIFT {{ strtoupper($rekap->shift)}}
                            </h3>
                            <div class="float-right">
                                <b>{{ \Carbon\Carbon::parse($rekap->tanggal_rekap)->isoFormat('dddd, D MMMM Y')}}</b>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>HARI/TANGGAL REKAP</th>
                                                <td>:</td>
                                                <td>{{ \Carbon\Carbon::parse($rekap->tanggal_rekap)->isoFormat('dddd, D MMMM Y')}}</td>
                                                <th>SHIFT</th>
                                                <td>:</td>
                                                <td>{{ strtoupper($rekap->shift)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="float-right mb-3">
                                <a href="{{ route('rekap.index')}}" class="btn btn-secondary">Kembali</a>
                                <a href="{{ route('rekap.print',$rekap->id)}}" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Print</a>
                            </div>
                            <table class="table table-bordered table-striped mb-5">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>PAKET CUCI</th>
                                        <th>HARGA</th>
                                        <th>QTY</th>
                                        <th>SUB TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_qty = 0;
                                        $total_harga = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($rekap_detail as $detail)
                                        @php
                                            $total_qty += $detail->qty;
                                            $total_harga += $detail->paket->harga;
                                            $total += $detail->total;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $detail->paket->nama_paket}}</td>
                                            <td>Rp. {{ number_format($detail->paket->harga,0,',','.')}}</td>
                                            <td>{{ $detail->qty}}</td>
                                            <td>Rp. {{ number_format($detail->paket->harga * $detail->qty,0,',','.')}}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">
                                            <b><i>Jumlah Unit</i></b>
                                        </th>
                                        <th>
                                            <b><i>{{ $total_qty }}</i></b>
                                        </th>
                                        <th>
                                            <b><i>Rp. {{ number_format($rekap->total,2,',','.') }}</i></b>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <table class="table table-bordered table-striped mb-5">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>KARYAWAN</th>
                                        <th>SHIFT</th>
                                        <th>PENDAPATAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_qty = 0;
                                        $total_harga = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($rekap_absensi as $absensi)
                                        @php
                                            $total_qty += $detail->qty;
                                            $total_harga += $detail->paket->harga;
                                            $total += $detail->total;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $absensi->karyawan->nama_karyawan}}</td>
                                            <td>{{ strtoupper($absensi->shift)}}</td>
                                            <td>Rp. {{ number_format($absensi->pendapatan,0,',','.')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">
                                            <b><i>Total Pendapatan Karyawan</i></b>
                                        </th>
                                        <th>
                                            <b><i>Rp. {{ number_format($rekap->total * 40/100,2,',','.') }}</i></b>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <b><i>Total Pendapatan Kantor</i></b>
                                        </th>
                                        <th>
                                            <b><i>Rp. {{ number_format($rekap->total * 60/100,2,',','.') }}</i></b>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
