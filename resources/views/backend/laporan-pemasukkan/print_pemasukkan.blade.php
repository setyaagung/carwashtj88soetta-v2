<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>REKAPAN PEMASUKKAN PER BULAN</title>

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}}">
    </head>
    <body>
            <h5 class="text-center mb-5"><u>REKAPAN PEMASUKKAN PER BULAN</u></h5>
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
                    <th>SHIFT</th>
                    <td>:</td>
                    <td>{{ strtoupper($shift)}}</td>
                </tr>
            </table>
            <table class="table table-bordered table-sm mb-3" style="font-size: 15px:width:100%">
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
                    @foreach ($pemasukkan->groupBy('tanggal_rekap') as $item)
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
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><b><i>Total Pemasukkan</i></b></td>
                        <td><b><i>Rp. {{ number_format($total_pemasukkan,0,',','.')}}</i></b></td>
                    </tr>
                </tfoot>
            </table>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/dist/js/adminlte.js')}}"></script>
    </body>
</html>
