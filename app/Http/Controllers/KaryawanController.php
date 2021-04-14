<?php

namespace App\Http\Controllers;

use App\Model\Absensi;
use App\Model\Bon;
use App\Model\Karyawan;
use App\User;
use Illuminate\Http\Request;

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
                'role_id' => 3,
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
        $data_absensi = Absensi::where('karyawan_id', $karyawan->id)->get();
        $data_bon = Bon::where('karyawan_id', $karyawan->id)->get();
        return view('backend.karyawan.show', compact('karyawan', 'data_absensi', 'data_bon'));
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
                'role_id' => 3,
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
}
