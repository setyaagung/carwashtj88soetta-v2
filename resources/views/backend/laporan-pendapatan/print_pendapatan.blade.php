@extends('layouts.print-main')

@section('title', 'LAPORAN PENDAPATAN')

@section('content')
    <h5 class="text-center mb-5"><u>LAPORAN PENDAPATAN</u></h5>
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
        </tr>
    </table>

    <table class="table table-bordered table-sm mb-3" style="font-size: 15px;width:100%;">
        <thead class="thead-dark">
            <tr>
                <th>NO</th>
                <th>KATEGORI</th>
                <th>SHIFT/JENIS</th>
                <th>QTY/UNIT</th>
                <th>SUB TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            <tr>
                <td rowspan="4">{{ $no++}}</td>
                <td rowspan="4">PEMASUKKAN</td>
                @foreach ($pemasukkan as $pmk)
                    <tr>
                        <td>{{ strtoupper($pmk->shift)}}</td>
                        <td>{{ $pmk->qty}}</td>
                        <td>Rp. {{ number_format($pmk->total,0,',','.')}}</td>
                    </tr>
                @endforeach
            </tr>
            <tr>
                @php
                    $count = \App\Model\Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])
                        ->orderBy('tanggal_pengeluaran', 'ASC')
                        ->count('jenis');
                @endphp
                <td rowspan="{{ $count}}">{{ $no++}}</td>
                <td rowspan="{{ $count}}">PENGELUARAN</td>
                @forelse ($pengeluaran as $pl)
                    <tr>
                        <td>{{ strtoupper($pl->jenis)}}</td>
                        <td>{{ $pl->count}}</td>
                        <td>Rp. {{ number_format($pl->jumlah,0,',','.')}}</td>
                    </tr>
                @empty
                    <td colspan="3" class="text-center">Data Pengeluaran Tidak Ditemukan</td>
                @endforelse
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><b><i>TOTAL PEMASUKKAN</i></b></td>
                <td><b><i>Rp. {{ number_format($total_pemasukkan,0,',','.')}}</i></b></td>
            </tr>
            <tr>
                <td colspan="4"><b><i>TOTAL PENGELUARAN</i></b></td>
                <td><b><i>Rp. {{ number_format($total_pengeluaran,0,',','.')}}</i></b></td>
            </tr>
            <tr>
                <td colspan="4"><b><i>TOTAL PENDAPATAN BERSIH</i></b></td>
                <td><h4><b><i><u>Rp. {{ number_format($total_pemasukkan - $total_pengeluaran,0,',','.')}}</u></i></b></h4></td>
            </tr>
        </tfoot>
    </table>
@endsection
