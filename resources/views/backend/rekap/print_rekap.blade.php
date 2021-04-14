<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>REKAP HARIAN</title>

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}}">
    </head>
    <body>
            <h5 class="text-center mb-5"><u>REKAPAN HARIAN</u></h5>
            <table class="table table-borderless table-sm mb-3" style="font-size: 15px">
                <tr>
                    <th>HARI</th>
                    <td>:</td>
                    <td>{{ strtoupper(\Carbon\Carbon::parse($rekap->tanggal_rekap)->isoFormat('dddd'))}}</td>
                    <th>SHIFT</th>
                    <td>:</td>
                    <td>{{ strtoupper($rekap->shift)}}</td>
                </tr>
                <tr>
                    <th>TANGGAL REKAP</th>
                    <td>:</td>
                    <td>{{ strtoupper(\Carbon\Carbon::parse($rekap->tanggal_rekap)->isoFormat('D MMMM Y'))}}</td>
                    <th>KASIR</th>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>
            <table class="table table-striped table-bordered table-sm mb-3" style="font-size: 15px">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>PAKET CUCI</th>
                        <th>HARGA</th>
                        <th>QTY/UNIT</th>
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
            <table class="table table-bordered table-striped table-sm mb-5" style="font-size: 15px">
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
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/dist/js/adminlte.js')}}"></script>
    </body>
</html>
