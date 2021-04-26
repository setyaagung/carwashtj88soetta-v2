<?php

namespace App\Http\Controllers;

use App\Model\Absensi;
use App\Model\Bon;
use App\Model\Karyawan;
use App\User;
use Illuminate\Http\Request;
use PDF;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('backend.karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'email.unique' => 'Maaf, email ini sudah digunakan user lain'
        ];
        $request->validate([
            'nama_karyawan' => 'required|string|max:191',
            'jabatan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], $message);
        $data = $request->all();
        if ($data['jabatan'] == 'kasir') {
            $user = User::create([
                'name' => $request->input('nama_karyawan'),
                'email' => $request->input('email'),
                'status' => 1,
                'role_id' => 2,
                'password' => bcrypt($request->input('password')),
            ]);
        }
        if ($data['jabatan'] == 'pencuci') {
            $user = User::create([
                'name' => $request->input('nama_karyawan'),
                'email' => $request->input('email'),
                'status' => 1,
                'role_id' => 2,
                'password' => bcrypt($request->input('password')),
            ]);
        }
        $data['user_id'] = $user->id;
        Karyawan::create($data);
        return redirect()->route('karyawan.index')->with('create', 'Data karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        //$data_absensi = Absensi::where('karyawan_id', $karyawan->id)->get();
        //$data_bon = Bon::where('karyawan_id', $karyawan->id)->get();
        return view('backend.karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('backend.karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $request->validate([
            'nama_karyawan' => 'required|string|max:191',
            'jabatan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);
        $data = $request->all();
        $user = User::where('id', $karyawan->user_id)->get()->first();
        if ($data['jabatan'] == 'kasir') {
            $user->update([
                'role_id' => 2,
            ]);
        }
        if ($data['jabatan'] == 'pencuci') {
            $user->update([
                'role_id' => 2,
            ]);
        }
        $karyawan->update($data);
        return redirect()->route('karyawan.index')->with('update', 'Data karyawan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('delete', 'Data karyawan berhasil dihapus');
    }

    public function filter(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $dari = date('Y-m-d', strtotime($request->dari));
        $sampai = date('Y-m-d', strtotime($request->sampai));

        $data_absensi = Absensi::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_absensi', [$dari, $sampai])->orderBy('tanggal_absensi', 'ASC')->get();
        $data_bon = Bon::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_bon', [$dari, $sampai])->orderBy('tanggal_bon', 'ASC')->get();
        $total_pendapatan = Absensi::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_absensi', [$dari, $sampai])->orderBy('tanggal_absensi', 'ASC')->sum('pendapatan');
        $total_bon = Bon::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_bon', [$dari, $sampai])->orderBy('tanggal_bon', 'ASC')->sum('jumlah');
        $gaji = $total_pendapatan - $total_bon;

        return view('backend.karyawan.show', compact('karyawan', 'data_absensi', 'data_bon', 'total_pendapatan', 'total_bon', 'gaji', 'dari', 'sampai'));
    }

    public function create_absensi($id)
    {
        $karyawan = Karyawan::where('id', $id)->first();
        return view('backend.karyawan.create_absensi', compact('karyawan'));
    }

    public function store_absensi(Request $request, $id)
    {
        $karyawan = Karyawan::where('id', $id)->first();
        $data = $request->all();
        $request->validate([
            'tanggal_absensi' => 'required',
            'shift' => 'required',
            'pendapatan' => 'required'
        ]);
        Absensi::create($data);
        return redirect()->route('karyawan.show', $karyawan->id)->with('create', 'Data absensi dan pendapatan harian karyawan berhasil ditambahkan');
    }

    public function edit_absensi($karyawan, $id)
    {
        $karyawan = Karyawan::where('id', $karyawan)->first();
        $absensi = Absensi::findOrFail($id);
        return view('backend.karyawan.edit_absensi', compact('absensi', 'karyawan'));
    }

    public function update_absensi(Request $request, $karyawan, $id)
    {
        $karyawan = Karyawan::where('id', $karyawan)->first();
        $absensi = Absensi::findOrFail($id);

        $data = $request->all();
        $request->validate([
            'tanggal_absensi' => 'required',
            'shift' => 'required',
            'pendapatan' => 'required'
        ]);

        $absensi->update($data);
        return redirect()->route('karyawan.show', $karyawan->id)->with('update', 'Data absensi dan pendapatan harian karyawan berhasil diperbarui');
    }

    public function destroy_absensi($karyawan, $id)
    {
        $karyawan = Karyawan::where('id', $karyawan)->first();
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return redirect()->back()->with('delete', 'Data absensi dan pendapatan harian karyawan berhasil dihapus');
    }

    public function print_gaji($id, $dari, $sampai)
    {
        $karyawan = Karyawan::findOrFail($id);

        $data_absensi = Absensi::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_absensi', [$dari, $sampai])->orderBy('tanggal_absensi', 'ASC')->get();
        $data_bon = Bon::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_bon', [$dari, $sampai])->orderBy('tanggal_bon', 'ASC')->get();
        $total_pendapatan = Absensi::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_absensi', [$dari, $sampai])->orderBy('tanggal_absensi', 'ASC')->sum('pendapatan');
        $total_bon = Bon::where('karyawan_id', $karyawan->id)->whereBetween('tanggal_bon', [$dari, $sampai])->orderBy('tanggal_bon', 'ASC')->sum('jumlah');
        $gaji = $total_pendapatan - $total_bon;

        $pdf = PDF::loadView('backend.karyawan.print_gaji', compact('karyawan', 'data_absensi', 'data_bon', 'total_pendapatan', 'total_bon', 'gaji', 'dari', 'sampai'))->setPaper('4x6in.', 'potrait');
        return $pdf->stream();
    }
}
