<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $pengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])
            ->orderBy('tanggal_pengeluaran', 'ASC')
            ->get();
        $total_pengeluaran = Pengeluaran::whereBetween('tanggal_pengeluaran', [$dari, $sampai])->orderBy('tanggal_pengeluaran', 'ASC')->sum('jumlah');
        return view('backend.laporan-pengeluaran.index', compact('pengeluaran', 'total_pengeluaran', 'dari', 'sampai', 'jenis'));
    }
}
