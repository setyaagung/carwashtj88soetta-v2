@extends('layouts.back-main')

@section('title','Laporan Pendapatan')

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
                        <div class="card-body">
                            <form action="{{ route('laporan-pendapatan.filter')}}" method="GET">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label><b>Dari</b></label>
                                        <input type="date" class="form-control" name="dari" id="dari" value="{{old('dari')}}" required>
                                        @error('dari')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Sampai</b></label>
                                        <input type="date" class="form-control" name="sampai" id="sampai" value="{{old('sampai')}}" required>
                                        @error('sampai')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2" style="margin-top: 32px">
                                        <button class="btn btn-primary form-control" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (isset($pemasukkan))
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">
                                        Laporan Pendapatan {{ \Carbon\Carbon::parse($dari)->isoFormat('D MMMM Y')}} sampai {{ \Carbon\Carbon::parse($sampai)->isoFormat('D MMMM Y')}}
                                    </h3>
                                    <div class="float-right">
                                        <a href="#" class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> <b><i>Cetak Pendapatan</i></b></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>JENIS</th>
                                                <th>SHIFT</th>
                                                <th>QTY/UNIT</th>
                                                <th>SUB TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                                $qty = DB::select('SELECT shift, SUM(qty) AS qty from rekap_detail JOIN rekap ON tanggal_rekap BETWEEN :dari AND :sampai WHERE rekap.id = rekap_detail.rekap_id GROUP BY shift',[
                                                    'dari' => $dari,
                                                    'sampai' => $sampai
                                                ]);
                                                $subtotal = DB::select('SELECT shift, SUM(total) AS total FROM rekap WHERE tanggal_rekap BETWEEN :dari AND :sampai GROUP BY shift', [
                                                    'dari' => $dari,
                                                    'sampai' => $sampai
                                                ]);
                                            @endphp
                                            <tr>
                                                <td rowspan="4">{{ $no++}}</td>
                                                <td rowspan="4">PEMASUKKAN</td>
                                                @foreach ($qty as $q)
                                                    <tr>
                                                        <td>{{ strtoupper($q->shift)}}</td>
                                                        <td>{{ $q->qty}}</td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($subtotal as $sb)
                                                <tr>
                                                    <td>Rp. {{ number_format($sb->total,0,',','.')}}</td>
                                                </tr>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @php
                                                    $count = \App\Model\Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])
                                                        ->orderBy('tanggal_pengeluaran', 'ASC')
                                                        ->count('jenis');
                                                @endphp
                                                <td rowspan="{{ $count + 1}}">{{ $no++}}</td>
                                                <td rowspan="{{ $count + 1}}">PENGELUARAN</td>
                                                @foreach ($pengeluaran as $pl)
                                                    <tr>
                                                        <td>{{ strtoupper($pl->jenis)}}</td>
                                                        <td>{{ $pl->count}}</td>
                                                        <td>Rp. {{ number_format($pl->jumlah,0,',','.')}}</td>
                                                    </tr>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
