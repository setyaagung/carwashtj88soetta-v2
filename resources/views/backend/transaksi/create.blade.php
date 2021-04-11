@extends('layouts.back-main')

@section('title','Transaksi')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paket">
                                Paket Cuci
                            </button>
                            <div class="float-right">
                                <b>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y')}}</b>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ $message }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($message = Session::get('errorTransaksi'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ $message }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ $message }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div style="min-height: 45.4vh">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Paket</th>
                                            <th>Shift</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Nama Kendaraan</th>
                                            <th>Plat Nomor</th>
                                            <th>Harga</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cartData as $index=>$item)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{ $item['name']}}</td>
                                                <form action="{{ route('transaksi.updatecart',$item['rowId'])}}" method="POST">
                                                    @csrf
                                                    <td>
                                                        <select name="shift" class="form-control form-control-sm @error('shift') is-invalid @enderror" required>
                                                            <option value="">-- Shift --</option>
                                                            <option value="pagi" {{ $item['shift'] == "pagi" ? "selected":""}}>Pagi</option>
                                                            <option value="sore" {{ $item['shift'] == "sore" ? "selected":""}}>Sore</option>
                                                            <option value="malam" {{ $item['shift'] == "malam" ? "selected":""}}>Malam</option>
                                                        </select>
                                                        @error('shift')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select name="kendaraan_id" class="form-control form-control-sm @error('kendaraan_id') is-invalid @enderror" required>
                                                            <option value="">-- Jenis Kendaraan --</option>
                                                            @foreach ($kendaraans as $kendaraan)
                                                                <option value="{{ $kendaraan->id}}" {{ $item['kendaraan_id'] == $kendaraan->id ? "selected":"" }}>{{ $kendaraan->jenis_kendaraan}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('kendaraan_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm @error('nama_kendaraan') is-invalid @enderror" name="nama_kendaraan" value="{{ $item['nama_kendaraan']}}" required>
                                                        @error('nama_kendaraan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" name="plat_nomor" class="form-control form-control-sm @error('plat_nomor') is-invalid @enderror" value="{{ $item['plat_nomor']}}" required>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                                            </div>
                                                            @error('plat_nomor')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                </form>
                                                <td>Rp. {{ number_format($item['price'],0,',','.')}}</td>
                                                <td>
                                                    <form action="{{ route('transaksi.removeitem',$item['rowId'])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="8">Empty Cart</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <table class="table table-sm table-borderless mb-2">
                                <tr>
                                    <th width="60%">Sub Total</th>
                                    <th width="40%" class="text-right">
                                        Rp. {{ number_format($data_total['sub_total'],2,',','.') }} </th>
                                </tr>
                                <tr>
                                    <th>
                                        <form action="{{ route('transaksi.create') }}" method="get">
                                            Discount 10%
                                            <input type="checkbox" {{ $data_total['diskon'] > 0 ? "checked" : ""}} name="diskon"
                                                value="true" onclick="this.form.submit()">
                                        </form>
                                    </th>
                                    <th class="text-right">Rp.
                                        {{ number_format($data_total['diskon'],2,',','.') }}</th>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-right font-weight-bold">
                                        Rp. {{ number_format($data_total['total'],2,',','.') }}
                                    </th>

                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-sm-4">
                                    <form action="{{ route('transaksi.clear')}}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-md btn-block" onclick="return confirm('Apakah anda yakin ingin meng-clear cart ?');" type="submit">
                                            Clear
                                        </button>
                                    </form>
                                </div>
                                <div class="col-sm-4">
                                    <a class="btn btn-primary btn-md btn-block" href="{{ route('transaksi.index')}}">History</a>
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-success btn-md btn-block" id="payButton" disabled data-toggle="modal" data-target="#modalPay">Bayar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Paket -->
    <div class="modal fade" id="paket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title modal-title w-100 text-light" id="exampleModalLabel">Paket Cuci TJ88</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Paket</th>
                                <th>Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pakets as $paket)
                                <tr>
                                    <form action="{{ route('transaksi.additem',$paket->id)}}" method="POST">
                                        @csrf
                                        <td>{{ $paket->nama_paket}}</td>
                                        <td>Rp. {{ number_format($paket->harga,0,',','.')}}</td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BAYAR -->
    <div class="modal fade" id="modalPay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title w-100 text-light" id="exampleModalLabel">Billing Information</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('transaksi.pay')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th width="60%">Sub Total</th>
                                <th width="40%" class="text-right">Rp.
                                    {{ number_format($data_total['sub_total'],2,',','.') }} </th>
                            </tr>
                            @if($data_total['diskon'] > 0)
                                <tr>
                                    <th>Discount 10%</th>
                                    <th class="text-right">Rp.
                                        {{ number_format($data_total['diskon'],2,',','.') }}</th>
                                </tr>
                            @endif
                        </table>
                        <div class="form-group">
                            <label>Input Nominal</label>
                            <input type="number" class="form-control" name="pay" id="oke" autofocus>
                        </div>
                        <h6 class="font-weight-bold">Total :</h6>
                        <h4 class="font-weight-bold mb-5">Rp. {{ number_format($data_total['total'],2,',','.') }}</h4>
                        <input id="totalHidden" type="hidden" name="totalHidden" value="{{$data_total['total']}}" />

                        <h6 class="font-weight-bold">Bayar :</h6>
                        <h4 class="font-weight-bold mb-5" id="paying"></h4>
                        <h6 class="font-weight-bold text-primary">Kembalian :</h6>
                        <h4 class="font-weight-bold text-primary" id="change"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveButton" disabled onclick="openWindowReload(this)">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            let totalBayar = {{ $data_total['total']}}
            const payButton = document.getElementById("payButton");
            if(totalBayar === 0){
                payButton.disabled = true;
            }else{
                payButton.disabled = false;
            }
            $('#modalPay').on('shown.bs.modal', function(){
                $('#oke').trigger('focus');
            });

            oke.oninput = function () {
                let total = parseInt(document.getElementById('totalHidden').value) ? parseInt(document.getElementById('totalHidden').value) : 0;
                let pay = parseInt(document.getElementById('oke').value) ? parseInt(document.getElementById('oke').value) : 0;
                let result = pay - total;
                document.getElementById("paying").innerHTML = pay ? 'Rp ' + convertToRupiah(pay) + ',00' : 'Rp ' + 0 +
                    ',00';
                document.getElementById("change").innerHTML = result ? 'Rp ' + convertToRupiah(result) + ',00' : 'Rp ' + 0 +
                    ',00';
                check(pay, total);
                const saveButton = document.getElementById("saveButton");
                if(total === 0){
                    saveButton.disabled = true;
                }
            }

            function check(pay, total) {
                const saveButton = document.getElementById("saveButton");
                if (pay < total) {
                    saveButton.disabled = true;
                } else {
                    saveButton.disabled = false;
                }
            }

            function convertToRupiah(number) {

                if (number) {
                    var rupiah = "";
                    var numberrev = number.toString().split("").reverse().join("");

                    for (var i = 0; i < numberrev.length; i++)
                    if (i % 3 == 0)
                        rupiah += numberrev.substr(i, 3) + ".";
                        return (rupiah.split("", rupiah.length - 1).reverse().join(""));
                }else{
                    return number;
                }
            }
        });
    </script>
@endpush
