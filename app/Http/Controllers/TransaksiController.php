<?php

namespace App\Http\Controllers;

use App\Model\Kendaraan;
use App\Model\Paket;
use App\Model\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $data_transaksi = Transaksi::orderBy('created_at', 'DESC')->get();
        return view('backend.transaksi.index', compact('data_transaksi'));
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

        //cart item
        if (request()->diskon) {
            $diskon = "-10%";
        } else {
            $diskon = "0%";
        }
        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => 'diskon',
            'type' => 'discount',
            'target' => 'total',
            'value' => $diskon,
            'order' => 1
        ]);

        \Cart::session(Auth::user()->id)->condition($condition);
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
        //tax
        $new_condition = \Cart::session(Auth::user()->id)->getCondition('diskon');
        $diskon = $new_condition->getCalculatedValue($sub_total);
        $data_total = [
            'sub_total' => $sub_total,
            'total' => $total,
            'diskon' => $diskon,
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

    public function clear()
    {
        \Cart::session(Auth::user()->id)->clear();
        return redirect()->back();
    }

    public function pay(Request $request)
    {
        $cart_total = \Cart::session(Auth::user()->id)->getTotal();
        $pay = request()->pay;
        $change = (int)$pay - (int)$cart_total;

        if ($change >= 0) {
            DB::beginTransaction();

            try {
                $all_cart = \Cart::session(Auth::user()->id)->getContent();
                $filterCart = $all_cart->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'shift' => $item->shift,
                        'kendaraan_id' => $item->kendaraan_id,
                        'nama_kendaraan' => $item->nama_kendaraan,
                        'plat_nomor' => $item->plat_nomor
                    ];
                });

                foreach ($filterCart as $cart) {
                    Transaksi::create([
                        'no_invoice' => 'TJ' . Carbon::now()->format('Ymd') . Str::random(6),
                        'user_id' => Auth::user()->id,
                        'tanggal' => Carbon::now()->format('Y-m-d'),
                        'paket_id' => $cart['id'],
                        'shift' => $cart['shift'],
                        'kendaraan_id' => $cart['kendaraan_id'],
                        'nama_kendaraan' => $cart['nama_kendaraan'],
                        'plat_nomor' => $cart['plat_nomor'],
                        'total' => $cart_total
                    ]);
                }
                \Cart::session(Auth::user()->id)->clear();

                DB::commit();
                return redirect()->back()->with('success', 'Transaksi Berhasil dilakukan | Klik History untuk print');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Data transaksi wajib diisi semua');
            }
        }
        return redirect()->back()->with('errorTransaksi', 'jumlah pembayaran tidak valid');
    }
}
