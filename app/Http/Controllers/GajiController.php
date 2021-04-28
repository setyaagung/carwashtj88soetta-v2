<?php

namespace App\Http\Controllers;

use App\Model\Absensi;
use App\Model\Bon;
use App\Model\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GajiController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::where('user_id', Auth::user()->id)->first();
        return view('frontend.informasi-gaji.index', compact('karyawan'));
    }

    public function filter(Request $request)
    {
        $karyawan = Karyawan::where('user_id', Auth::user()->id)->first();

        $dari = date('Y-m-d', strtotime($request->dari));
        $sampai = date('Y-m-d', strtotime($request->sampai));

        $data_absensi = Absensi::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_absensi', [$dari, $sampai])->orderBy('tanggal_absensi', 'ASC')->get();
        $data_bon = Bon::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_bon', [$dari, $sampai])->orderBy('tanggal_bon', 'ASC')->get();
        $total_pendapatan = Absensi::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_absensi', [$dari, $sampai])->orderBy('tanggal_absensi', 'ASC')->sum('pendapatan');
        $total_bon = Bon::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_bon', [$dari, $sampai])->orderBy('tanggal_bon', 'ASC')->sum('jumlah');
        $gaji = $total_pendapatan - $total_bon;

        return view('frontend.informasi-gaji.index', compact('karyawan', 'data_absensi', 'data_bon', 'total_pendapatan', 'total_bon', 'gaji', 'dari', 'sampai'));
    }
}
