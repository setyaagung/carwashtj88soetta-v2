<?php

namespace App\Http\Controllers;

use App\Model\Pengeluaran;
use App\Model\Rekap;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pemasukkan = Rekap::whereMonth('tanggal_rekap', Carbon::now()->month)->sum('total');
        $pengeluaran = Pengeluaran::whereMonth('tanggal_pengeluaran', Carbon::now()->month)->sum('jumlah');
        $users = User::count();
        return view('backend.dashboard', compact('pemasukkan', 'pengeluaran', 'users'));
    }
}
