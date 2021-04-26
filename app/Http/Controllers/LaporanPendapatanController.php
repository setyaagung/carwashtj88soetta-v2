<?php

namespace App\Http\Controllers;

use App\Model\Pengeluaran;
use App\Model\Rekap;
use App\Model\RekapDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPendapatanController extends Controller
{
    public function index()
    {
        return view('backend.laporan-pendapatan.index');
    }

    public function filter(Request $request)
    {
        $this->validate($request, [
            'dari' => 'required',
            'sampai' => 'required',
        ]);

        $dari = date('Y-m-d', strtotime($request->dari));
        $sampai = date('Y-m-d', strtotime($request->sampai));

        //pemasukkan
        $pemasukkan = Rekap::whereBetween('tanggal_rekap', [$dari, $sampai])
            ->orderBy('tanggal_rekap', 'ASC')
            ->get();
        $total_pemasukkan = Rekap::whereBetween('tanggal_rekap', [$dari, $sampai])->orderBy('tanggal_rekap', 'ASC')->sum('total');
        //pengeluaran
        $pengeluaran = DB::select('SELECT jenis, count(jenis) as count, sum(jumlah) as jumlah FROM pengeluaran WHERE tanggal_pengeluaran BETWEEN :dari AND :sampai GROUP BY jenis', [
            'dari' => $dari,
            'sampai' => $sampai
        ]);
        $total_pengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])->orderBy('tanggal_pengeluaran', 'ASC')->sum('jumlah');
        return view('backend.laporan-pendapatan.index', compact('pengeluaran', 'total_pengeluaran', 'pemasukkan', 'total_pemasukkan', 'dari', 'sampai'));
    }
}
