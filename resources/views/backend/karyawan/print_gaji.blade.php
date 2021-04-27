@extends('layouts.print-main')

@section('title','GAJI KARYAWAN PER BULAN')

@section('content')
    <h5 class="text-center mb-5"><u>GAJI KARYAWAN PER BULAN</u></h5>
    <table class="table table-borderless table-sm mb-3" style="font-size: 15px">
        <tr>
            <th>DARI</th>
            <td>:</td>
            <td>{{ strtoupper(\Carbon\Carbon::parse($dari)->isoFormat('DD MMMM Y'))}}</td>
            <th>TANGGAL CETAK</th>
            <td>:</td>
            <td>{{ strtoupper(\Carbon\Carbon::now()->isoFormat('DD MMMM Y'))}}</td>
        </tr>
        <tr>
            <th>SAMPAI</th>
            <td>:</td>
            <td>{{  strtoupper(\Carbon\Carbon::parse($sampai)->isoFormat('DD MMMM Y'))}}</td>
            <th>NAMA KARYAWAN</th>
            <td>:</td>
            <td>{{ strtoupper($karyawan->nama_karyawan)}}</td>
        </tr>
    </table>

    <table class="table table-bordered table-sm mb-3" style="font-size: 15px:width:100%">
        <thead class="thead-dark">
            <tr>
                <th>NO</th>
                <th>TANGGAL ABSENSI</th>
                <th>SHIFT</th>
                <th>PENDAPATAN</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data_absensi as $absensi)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ \Carbon\Carbon::parse($absensi->tanggal_absensi)->isoFormat('dddd, DD MMMM Y')}}</td>
                    <td>{{ strtoupper($absensi->shift)}}</td>
                    <td>Rp. {{ number_format($absensi->pendapatan,0,',','.')}}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="4">Data kosong</td>
                </tr>
            @endforelse
        </tbody>
        <thead class="thead-dark">
            <tr>
                <th>NO</th>
                <th>TANGGAL BON</th>
                <th>KETERANGAN</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_bon as $bon)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ \Carbon\Carbon::parse($bon->tanggal_bon)->isoFormat('dddd, D MMMM Y')}}</td>
                    <td>{{ $bon->keterangan}}</td>
                    <td>Rp. {{ number_format($bon->jumlah,0,',','.')}}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="4">Data kosong</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><b><i>Total Pendapatan : </i></b></td>
                <td><b><i>Rp. {{ number_format($total_pendapatan,0,',','.')}}</i></b></td>
            </tr>
            <tr>
                <td colspan="3"><b><i>Total Bon : </i></b></td>
                <td><b><i>Rp. {{ number_format($total_bon,0,',','.')}}</i></b></td>
            </tr>
            <tr>
                <td colspan="3"><b><i>Total Gaji Yang Diperoleh : </i></b></td>
                <td style="font-size: 20px"><b><i><u>Rp. {{ number_format($gaji,0,',','.')}}</u></i></b></td>
            </tr>
        </tfoot>
    </table>
@endsection
