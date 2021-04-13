<?php

namespace App\Http\Controllers;

use App\Model\Absensi;
use App\Model\Karyawan;
use App\Model\Paket;
use App\Model\Rekap;
use App\Model\RekapDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_rekap = Rekap::orderBy('tanggal_rekap', 'DESC')->get();
        return view('backend.rekap.index', compact('data_rekap'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pakets = Paket::orderBy('nama_paket', 'ASC')->get();
        $karyawans = Karyawan::orderBy('nama_karyawan')->get();
        $items = \Cart::session(Auth::user()->id)->getContent();
        if (\Cart::isEmpty()) {
            $cartData = [];
        } else {
            foreach ($items as $row) {
                $cart[] = [
                    'rowId' => $row->id,
                    'name' => $row->name,
                    'qty' => $row->quantity,
                    'pricesingle' => $row->price,
                    'price' => $row->getPriceSum(),
                    'created_at' => $row->attributes['created_at'],
                ];
            }

            $cartData = collect($cart)->sortBy('created_at');
        }
        //total
        $qty_total = \Cart::session(Auth::user()->id)->getTotalQuantity();
        $total = \Cart::session(Auth::user()->id)->getTotal();
        $data_total = [
            'qty_total' => $qty_total,
            'total' => $total,
        ];
        return view('backend.rekap.create', compact('pakets', 'karyawans', 'cartData', 'data_total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function addItem($id)
    {
        $paket = Paket::findOrFail($id);
        $cart = \Cart::session(Auth::user()->id)->getContent();
        $checkItemId = $cart->whereIn('id', $id);

        if ($checkItemId->isNotEmpty()) {
            if ($checkItemId[$id]->quantity >= 1) {
                return redirect()->back()->with('error', 'Paket cuci yang dipilih sudah ada didalam cart');
            }
        } else {
            \Cart::session(Auth::user()->id)->add([
                'id' => $id,
                'name' => $paket->nama_paket,
                'price' => $paket->harga,
                'quantity' => 1,
                'attributes' => array(
                    'created_at' => date('Y-m-d H:i:s')
                )
            ]);
        }
        return redirect()->back();
    }

    public function removeItem($id)
    {
        \Cart::session(Auth::user()->id)->remove($id);
        return redirect()->back();
    }

    public function updatecart(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItemId = $cart->whereIn('id', $id);
        $quantity = $request->quantity;

        \Cart::session(Auth::user()->id)->update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $quantity
            )
        ));

        return redirect()->back();
    }

    public function clear()
    {
        \Cart::session(Auth::user()->id)->clear();
        return redirect()->back();
    }

    public function verifikasi(Request $request)
    {
        $cart_total = \Cart::session(Auth::user()->id)->getTotal();
        $tanggal_rekap = request()->tanggal_rekap;
        $shift = request()->shift;
        $jumlah = request()->jumlah;

        DB::beginTransaction();
        try {
            $all_cart = \Cart::session(Auth::user()->id)->getContent();

            $filterCart = $all_cart->map(function ($item) {
                return [
                    'id' => $item->id,
                    'quantity' => $item->quantity
                ];
            });

            $rekap = Rekap::create([
                'tanggal_rekap' => $tanggal_rekap,
                'shift' => $shift,
                'total' => $cart_total
            ]);

            foreach (request()->karyawan_id as $key => $value) {
                Absensi::create([
                    'rekap_id' => $rekap->id,
                    'karyawan_id' => request()->karyawan_id[$key],
                    'tanggal_absensi' => $tanggal_rekap,
                    'shift' => $shift,
                    'pendapatan' => ($cart_total * 40 / 100) / request()->jumlah
                ]);
            }

            foreach ($filterCart as $cart) {
                RekapDetail::create([
                    'rekap_id' => $rekap->id,
                    'paket_id' => $cart['id'],
                    'qty' => $cart['quantity']
                ]);
            }
            \Cart::session(Auth::user()->id)->clear();
            DB::commit();
            return redirect()->back()->with('success', 'Input Rekap Berhasil dilakukan | Klik History untuk print');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Input rekap wajib diisi semua');
        }
        return redirect()->back()->with('errorRekap', 'Ada yang salah dalam penginputan rekapitulasi');
    }
}
