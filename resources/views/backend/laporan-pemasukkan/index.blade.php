@extends('layouts.back-main')

@section('title','Laporan Pemasukkan')

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
                            <form action="{{ route('laporan-pemasukkan.filter')}}" method="GET">
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
                                        <label><b>Shift</b></label>
                                        <select name="shift" class="form-control">
                                            <option value="all">ALL</option>
                                            <option value="pagi">PAGI</option>
                                            <option value="sore">SORE</option>
                                            <option value="malam">MALAM</option>
                                        </select>
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
                                        Laporan Pemasukkan {{ \Carbon\Carbon::parse($dari)->isoFormat('D MMMM Y')}} sampai {{ \Carbon\Carbon::parse($sampai)->isoFormat('D MMMM Y')}}
                                    </h3>
                                    <div class="float-right">
                                        <a href="{{ route('laporan-pemasukkan.print_pemasukkan', [$dari,$sampai,$shift])}}" class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> <b><i>Cetak Pemasukkan</i></b></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>HARI/TANGGAL REKAP</th>
                                                <th>SHIFT</th>
                                                <th>QTY/UNIT</th>
                                                <th>SUB TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pemasukkan->groupBy('tanggal_rekap') as $item)
                                                <tr>
                                                    <td rowspan="{{ count($item) + 1}}">{{ $loop->iteration}}</td>
                                                    <td rowspan="{{ count($item) + 1}}">{{ \Carbon\Carbon::parse($item[0]['tanggal_rekap'])->isoFormat('dddd, D MMMM Y')}}</td>
                                                    @foreach ($item as $pm)
                                                        @php
                                                            $total_qty = \App\Model\RekapDetail::where('rekap_id',$pm->id)->sum('qty');
                                                        @endphp
                                                        <tr>
                                                            <td>{{ strtoupper($pm->shift)}}</td>
                                                            <td>{{ $total_qty }} Unit</td>
                                                            <td>Rp. {{ number_format($pm->total,0,',','.')}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tr>
                                        @empty
                                            <td colspan="5" class="text-center">Data Pemasukkan Tidak Ditemukan</td>
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"><b><i>Total Pemasukkan</i></b></td>
                                                <td><b><i>Rp. {{ number_format($total_pemasukkan,0,',','.')}}</i></b></td>
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
