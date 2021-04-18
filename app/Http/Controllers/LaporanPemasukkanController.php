<?php

namespace App\Http\Controllers;

use App\Model\Rekap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPemasukkanController extends Controller
{
    public function index()
    {
        return view('backend.laporan-pemasukkan.index');
    }

    public function filter(Request $request)
    {
        $this->validate($request, [
            'dari' => 'required',
            'sampai' => 'required',
        ]);

        $dari = date('Y-m-d', strtotime($request->dari));
        $sampai = date('Y-m-d', strtotime($request->sampai));
        $shift = $request->shift;

        if ($shift == '') {
            $pemasukkan = Rekap::whereBetween('tanggal_rekap', [$dari, $sampai])
                ->orderBy('tanggal_rekap', 'ASC')
                ->get();
            $total_pemasukkan = Rekap::whereBetween('tanggal_rekap', [$dari, $sampai])->orderBy('tanggal_rekap', 'ASC')->sum('total');
        } else {
            $pemasukkan = Rekap::where('shift', $shift)->whereBetween('tanggal_rekap', [$dari, $sampai])
                ->orderBy('tanggal_rekap', 'ASC')
                ->get();
            $total_pemasukkan = Rekap::where('shift', $shift)->whereBetween('tanggal_rekap', [$dari, $sampai])->orderBy('tanggal_rekap', 'ASC')->sum('total');
        }
        return view('backend.laporan-pemasukkan.index', compact('pemasukkan', 'total_pemasukkan', 'dari', 'sampai'));
    }
}
