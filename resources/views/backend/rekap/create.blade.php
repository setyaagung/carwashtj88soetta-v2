@extends('layouts.back-main')

@section('title','Input Data Rekap')

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

                            @if ($message = Session::get('errorRekap'))
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
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Sub Total</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cartData as $index=>$item)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{ $item['name']}}</td>
                                                <form action="{{ route('rekap.updatecart',$item['rowId'])}}" method="POST">
                                                    @csrf
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" name="quantity" class="form-control form-control-sm" value="{{ $item['qty']}}" required>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </form>
                                                <td>Rp. {{ number_format($item['pricesingle'],0,',','.')}}</td>
                                                <td>Rp. {{ number_format($item['price'],0,',','.')}}</td>
                                                <td>
                                                    <form action="{{ route('rekap.removeitem',$item['rowId'])}}" method="POST">
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
                                    <th>Total Quantity</th>
                                    <th class="text-right font-weight-bold">
                                        {{ $data_total['qty_total']}} Unit
                                    </th>
                                </tr>
                                <tr>
                                    <th>Kantor 60%</th>
                                    <th class="text-right font-weight-bold">
                                        Rp. {{ number_format($data_total['total']*60/100,2,',','.') }}
                                    </th>
                                </tr>
                                <tr>
                                    <th>Karyawan 40%</th>
                                    <th class="text-right font-weight-bold">
                                        Rp. {{ number_format($data_total['total']*40/100,2,',','.') }}
                                    </th>

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
                                    <form action="{{ route('rekap.clear')}}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-md btn-block" onclick="return confirm('Apakah anda yakin ingin meng-clear cart ?');" type="submit">
                                            Clear
                                        </button>
                                    </form>
                                </div>
                                <div class="col-sm-4">
                                    <a class="btn btn-primary btn-md btn-block" href="{{ route('rekap.index')}}">History</a>
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-success btn-md btn-block" id="verifikasiButton" disabled data-toggle="modal" data-target="#modalVerifikasi">Verifikasi</button>
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
                                    <form action="{{ route('rekap.additem',$paket->id)}}" method="POST">
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
    <div class="modal fade" id="modalVerifikasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title w-100 text-light" id="exampleModalLabel">Verifikasi Rekap</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('rekap.verifikasi')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Rekap</label>
                            <input type="date" class="form-control" name="tanggal_rekap" id="oke" value="{{ date('Y-m-d')}}" required>
                        </div>
                        <div class="form-group">
                            <label>Shift</label>
                            <select name="shift" class="form-control" id="shift" onchange="return check();" required>
                                <option value="">-- Pilih Shift --</option>
                                <option value="pagi">Pagi</option>
                                <option value="sore">Sore</option>
                                <option value="malam">Malam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Karyawan</th>
                                        <th>
                                            <a href="#" class="btn btn-sm btn-success addRow"><i class="fas fa-plus"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="oke" class="body_karyawan">
                                    <tr>
                                        <td>
                                            <select name="karyawan_id[]" class="form-control form-control-sm karyawan" required>
                                                <option value="">-- Pilih Karyawan --</option>
                                                @foreach ($karyawans as $karyawan)
                                                    <option value="{{ $karyawan->id}}">{{ $karyawan->nama_karyawan}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger remove"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="text-align: right">Jumlah</td>
                                        <td>
                                            <span class="jumlah">1</span>
                                            <input id="jumlah" type="hidden" name="jumlah"/>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <h6 class="font-weight-bold">Total :</h6>
                        <h4 class="font-weight-bold mb-5">Rp. {{ number_format($data_total['total'],2,',','.') }}</h4>
                        <h6 class="font-weight-bold">Pendapatan Per Karyawan :</h6>
                        <h4 class="font-weight-bold mb-5" id="pendapatan_karyawan">Rp. {{ number_format($data_total['total']*40/100,2,',','.') }}</h4>
                        <h6 class="font-weight-bold text-primary">Pendapatan Kantor :</h6>
                        <h4 class="font-weight-bold text-primary" id="pendapatan_kantor">Rp. {{ number_format($data_total['total']*60/100,2,',','.') }}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveButton" disabled onclick="openWindowReload(this)">Simpan</button>
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
            const verifikasiButton = document.getElementById("verifikasiButton");
            if(totalBayar === 0){
                verifikasiButton.disabled = true;
            }else{
                verifikasiButton.disabled = false;
            }
        });

        function check(){
            const saveButton = document.getElementById("saveButton");
            var selectBox = document.getElementById('shift');
            var userInput = selectBox.options[selectBox.selectedIndex].value;
            if (userInput == '')
            {
                saveButton.disabled = true;
            }else{
                saveButton.disabled = false;
            }
            return false;
        }

        $('.addRow').on('click',function(){
            addRow();
        });

        function addRow(){
            var tr ='';
                    tr += '<tr>';
                        tr += '<td>';
                            tr += '<select name="karyawan_id[]" class="form-control form-control-sm karyawan" required>';
                                tr += '<option value="">-- Pilih Karyawan --</option>';
                                    tr += '@foreach ($karyawans as $karyawan)';
                                        tr += '<option value="{{ $karyawan->id}}">{{ $karyawan->nama_karyawan}}</option>';
                                    tr += '@endforeach';
                            tr += '</select>';
                        tr += '</td>';
                        tr += '<td>';
                            tr += '<a href="#" class="btn btn-sm btn-danger remove"><i class="fas fa-trash"></i></a>';
                        tr += '</td>';
                    tr += '</tr>';
            $('.body_karyawan').append(tr);
            var count = 0;
            var pendapatan_karyawan = {{ $data_total['total']*40/100 }};
            $('.jumlah').html(count + $('.body_karyawan tr').length);
            $('#pendapatan_karyawan').html('Rp '+convertToRupiah(pendapatan_karyawan / (count + $('.body_karyawan tr').length))+',00');
        }

        $('.remove').live('click', function(){
            var count = 0;
            var pendapatan_karyawan = {{ $data_total['total']*40/100 }};
            if($('.body_karyawan tr').length == 1){
                alert('Anda tidak dapat menghapus baris terakhir');
                $('.jumlah').html(count + $('.body_karyawan tr').length);
                $('#pendapatan_karyawan').html('Rp '+convertToRupiah(pendapatan_karyawan / (count + $('.body_karyawan tr').length))+',00');
            }else{
                $(this).parent().parent().remove();
                $('.jumlah').html(count + $('.body_karyawan tr').length);
                $('#pendapatan_karyawan').html('Rp '+convertToRupiah(pendapatan_karyawan / (count + $('.body_karyawan tr').length))+',00');
            }
        });

        $('input[name=jumlah]').val(0 + $('.body_karyawan tr').length);

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
    </script>
@endpush
