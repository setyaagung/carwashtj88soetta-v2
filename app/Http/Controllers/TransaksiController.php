<?php

namespace App\Http\Controllers;

use App\Model\Kendaraan;
use App\Model\Paket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = 'TJ' . Carbon::now()->format('Ymd') . Str::random(6);
        $pakets = Paket::orderBy('nama_paket', 'ASC')->get();
        $kendaraans = Kendaraan::orderBy('jenis_kendaraan', 'ASC')->get();

        //$condition = new \Darryldecode\Cart\CartCondition([
        //    'target' => 'total'
        //]);

        //\Cart::session(Auth::user()->id);
        $items = \Cart::session(Auth::user()->id)->getContent();
        if (\Cart::isEmpty()) {
            $cartData = [];
        } else {
            foreach ($items as $row) {
                $cart[] = [
                    'rowId' => $row->id,
                    'shift' => $row->shift,
                    'name' => $row->name,
                    'kendaraan_id' => $row->kendaraan_id,
                    'nama_kendaraan' => $row->nama_kendaraan,
                    'plat_nomor' => $row->plat_nomor,
                    'price' => $row->price,
                    'created_at' => $row->attributes['created_at']
                ];
            }
            $cartData = collect($cart)->sortBy('created_at');
        }
        //total
        $sub_total = \Cart::session(Auth::user()->id)->getSubTotal();
        $total = \Cart::session(Auth::user()->id)->getTotal();

        $data_total = [
            'sub_total' => $sub_total,
            'total' => $total,
        ];
        return view('backend.transaksi.create', compact('invoice', 'pakets', 'kendaraans', 'cartData', 'data_total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
                    'no_invoice' => 'TJ' . Carbon::now()->format('Ymd') . Str::random(6),
                    'tanggal' => date('Y-m-d'),
                    'created_at' => date('Y-m-d H:i:s')
                )
            ]);
        }
        return redirect()->back();
    }

    public function updatecart(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItemId = $cart->whereIn('id', $id);

        \Cart::session(Auth::user()->id)->update($id, array(
            'shift' => $request->input('shift'),
            'kendaraan_id' => $request->input('kendaraan_id'),
            'nama_kendaraan' => $request->input('nama_kendaraan'),
            'plat_nomor' => $request->input('plat_nomor')
        ));
        return redirect()->back();
    }

    public function removeItem($id)
    {
        \Cart::session(Auth()->id())->remove($id);
        return redirect()->back();
    }
}
