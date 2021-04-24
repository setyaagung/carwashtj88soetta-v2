<?php

namespace App\Http\Controllers;

use App\Model\Pengeluaran;
use Illuminate\Http\Request;
use PDF;

class LaporanPengeluaranController extends Controller
{
    public function index()
    {
        return view('backend.laporan-pengeluaran.index');
    }

    public function filter(Request $request)
    {
        $this->validate($request, [
            'dari' => 'required',
            'sampai' => 'required',
        ]);

        $dari = date('Y-m-d', strtotime($request->dari));
        $sampai = date('Y-m-d', strtotime($request->sampai));
        $jenis = $request->jenis;

        if ($jenis == 'all') {
            $pengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])
                ->orderBy('tanggal_pengeluaran', 'ASC')
                ->get();
            $total_pengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])->orderBy('tanggal_pengeluaran', 'ASC')->sum('jumlah');
        } else {
            $pengeluaran = Pengeluaran::where('jenis', $jenis)->whereBetween('tanggal_pengeluaran', [$dari, $sampai])
                ->orderBy('tanggal_pengeluaran', 'ASC')
                ->get();
            $total_pengeluaran = Pengeluaran::where('jenis', $jenis)->whereBetween('tanggal_pengeluaran', [$dari, $sampai])->orderBy('tanggal_pengeluaran', 'ASC')->sum('jumlah');
        }
        return view('backend.laporan-pengeluaran.index', compact('pengeluaran', 'total_pengeluaran', 'dari', 'sampai', 'jenis'));
    }

    public function print_pengeluaran($dari, $sampai, $jenis)
    {
        if ($jenis == 'all') {
            $pengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])
                ->orderBy('tanggal_pengeluaran', 'ASC')
                ->get();
            $total_pengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])->orderBy('tanggal_pengeluaran', 'ASC')->sum('jumlah');
        } else {
            $pengeluaran = Pengeluaran::where('jenis', $jenis)->whereBetween('tanggal_pengeluaran', [$dari, $sampai])
                ->orderBy('tanggal_pengeluaran', 'ASC')
                ->get();
            $total_pengeluaran = Pengeluaran::where('jenis', $jenis)->whereBetween('tanggal_pengeluaran', [$dari, $sampai])->orderBy('tanggal_pengeluaran', 'ASC')->sum('jumlah');
        }
        $pdf = PDF::loadView('backend.laporan-pengeluaran.print_pengeluaran', compact('pengeluaran', 'total_pengeluaran', 'dari', 'sampai', 'jenis'))->setPaper('4x6in.', 'potrait');
        return $pdf->stream();
    }
}
