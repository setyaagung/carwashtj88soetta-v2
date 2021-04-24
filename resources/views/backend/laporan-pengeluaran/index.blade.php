@extends('layouts.back-main')

@section('title','Laporan Pengeluaran')

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
                            <form action="{{ route('laporan-pengeluaran.filter')}}" method="GET">
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
                                    <div class="form-group col-md-2">
                                        <label><b>Jenis</b></label>
                                        <select name="jenis" class="form-control">
                                            <option value="all">ALL</option>
                                            <option value="bon">BON</option>
                                            <option value="gaji">GAJI</option>
                                            <option value="kantor">KANTOR</option>
                                            <option value="listrik">LISTRIK</option>
                                            <option value="shampo">SHAMPO</option>
                                            <option value="semir">SEMIR</option>
                                            <option value="DLL">DLL</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2" style="margin-top: 32px">
                                        <button class="btn btn-primary form-control" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (isset($pengeluaran))
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">
                                        Laporan Pengeluaran {{ \Carbon\Carbon::parse($dari)->isoFormat('D MMMM Y')}} sampai {{ \Carbon\Carbon::parse($sampai)->isoFormat('D MMMM Y')}}
                                    </h3>
                                    <div class="float-right">
                                        <a href="{{ route('laporan-pengeluaran.print_pengeluaran', [$dari,$sampai,$jenis])}}" class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> <b><i>Cetak Pengeluaran</i></b></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>HARI/TANGGAL PENGELUARAN</th>
                                                <th>JENIS</th>
                                                <th>KETERANGAN</th>
                                                <th>JUMLAH</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengeluaran as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->isoFormat('dddd, D MMMM Y')}}</td>
                                                    <td>{{ strtoupper($item->jenis)}}</td>
                                                    <td>{{ strtoupper($item->keterangan)}}</td>
                                                    <td>Rp. {{ number_format($item->jumlah,0,',','.')}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"><b><i>Total Pengeluaran</i></b></td>
                                                <td><b><i>Rp. {{ number_format($total_pengeluaran,0,',','.')}}</i></b></td>
                                            </tr>
                                        </tfoot>
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
