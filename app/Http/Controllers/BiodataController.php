<?php

namespace App\Http\Controllers;

use App\Model\Karyawan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::where('user_id', Auth::user()->id)->first();
        $user = User::where('id', $karyawan->user_id)->first();
        return view('frontend.biodata.index', compact('karyawan', 'user'));
    }

    public function update(Request $request)
    {
        $karyawan = Karyawan::where('user_id', Auth::user()->id)->first();
        $user = User::where('id', $karyawan->user_id)->first();
        $request->validate([
            'nama_karyawan' => 'required|string|max:191',
            'jabatan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
        ]);
        $data = $request->all();
        if ($data['jabatan'] == 'kasir') {
            $user->update([
                'email' => $request->input('email'),
                'role_id' => 2,
            ]);
        }
        if ($data['jabatan'] == 'pencuci') {
            $user->update([
                'email' => $request->input('email'),
                'role_id' => 2,
            ]);
        }
        $karyawan->update($data);
        return redirect()->route('biodata')->with('update', 'Data anda berhasil diperbarui');
    }
}
