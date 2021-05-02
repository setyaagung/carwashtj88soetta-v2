@extends('layouts.front-main')

@section('title')
    Informasi Gaji
@endsection

@section('content')
    <!-- /.content-header -->
    <section class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mt-4">
                        <div class="card-body">
                            <form action="{{ route('informasi-gaji.filter')}}" method="GET">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label><b>Dari</b></label>
                                        <input type="date" class="form-control" name="dari" id="dari" value="{{old('dari')}}">
                                        @error('dari')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><b>Sampai</b></label>
                                        <input type="date" class="form-control" name="sampai" id="sampai" value="{{old('sampai')}}">
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
                    @if (isset($gaji))
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5><b><i>Pendapatan bersih dari tanggal {{ \Carbon\Carbon::parse($dari)->isoFormat('D MMMM Y')}} sampai {{ \Carbon\Carbon::parse($sampai)->isoFormat('D MMMM Y')}} : </i></b></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><b><i><u>Rp. {{ number_format($gaji,0,',','.')}}</u></i></b></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @if (isset($data_absensi))
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($data_absensi as $absensi)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($absensi->tanggal_absensi)->isoFormat('dddd, D MMMM Y')}}</td>
                                                        <td>{{ strtoupper($absensi->shift)}}</td>
                                                        <td>Rp. {{ number_format($absensi->pendapatan,0,',','.')}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="3">Data kosong</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"><b><i>Total Pendapatan</i></b></td>
                                                    <td colspan="2"><b><i>Rp. {{ number_format($total_pendapatan,0,',','.')}}</i></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (isset($data_bon))
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
                                                    <th>KETERANGAN</th>
                                                    <th>JUMLAH</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($data_bon as $bon)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($bon->tanggal_bon)->isoFormat('dddd, D MMMM Y')}}</td>
                                                        <td>{{ $bon->keterangan}}</td>
                                                        <td>Rp. {{ number_format($bon->jumlah,0,',','.')}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="3">Data kosong</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"><b><i>Total Bon</i></b></td>
                                                    <td><b><i>Rp. {{ number_format($total_bon,0,',','.')}}</i></b></td>
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
        </div>
    </section>
@endsection
