@extends('layouts.print-main')

@section('title', 'LAPORAN PENGELUARAN')

@section('content')
    <h5 class="text-center mb-5"><u>LAPORAN PENGELUARAN</u></h5>
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
            <th>JENIS</th>
            <td>:</td>
            <td>{{ strtoupper($jenis)}}</td>
        </tr>
    </table>

    <table class="table table-bordered table-sm mb-3" style="font-size: 15px:width:100%">
        <thead class="thead-dark">
            <tr>
                <th>NO</th>
                <th>HARI/TANGGAL</th>
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
@endsection
