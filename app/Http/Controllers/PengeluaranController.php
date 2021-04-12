<?php

namespace App\Http\Controllers;

use App\Model\Bon;
use App\Model\Karyawan;
use App\Model\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pengeluaran = Pengeluaran::orderBy('tanggal_pengeluaran', 'DESC')->get();
        return view('backend.pengeluaran.index', compact('data_pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_karyawan = Karyawan::all();
        return view('backend.pengeluaran.create', compact('data_karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pengeluaran' => 'required',
            'nama_pengeluaran' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required'
        ]);
        $data = $request->all();
        $pengeluaran = Pengeluaran::create($data);
        if ($data['jenis'] == 'bon') {
            $request->validate([
                'karyawan_id' => 'required'
            ]);
            Bon::create([
                'tanggal_bon' => $pengeluaran->tanggal_pengeluaran,
                'pengeluaran_id' => $pengeluaran->id,
                'karyawan_id' => $request->input('karyawan_id'),
                'jumlah' => $pengeluaran->jumlah,
                'keterangan' => $pengeluaran->keterangan,
            ]);
        }
        return redirect()->route('pengeluaran.index')->with('create', 'Data pengeluaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with('delete', 'Data pengeluaran berhasil dihapus');
    }
}
