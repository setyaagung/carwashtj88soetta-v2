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
                            <h3 class="card-title font-weight-bold">
                                Transaksi
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaksi.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">No Invoice</label>
                                            <input type="text" name="no_invoice" class="form-control @error('no_invoice') is-invalid @enderror" value="{{ $invoice}}" required disabled>
                                            @error('no_invoice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ \Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                            @error('tanggal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Shift</label>
                                            <select name="shift" class="form-control @error('shift') is-invalid @enderror" required>
                                                <option value="">-- Pilih Shift --</option>
                                                <option value="pagi">PAGI</option>
                                                <option value="sore">SORE</option>
                                                <option value="malam">MALAM</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Paket</label>
                                            <select name="paket_id" class="form-control @error('paket_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Paket --</option>
                                                @foreach ($pakets as $paket)
                                                    <option value="{{ $paket->id}}">{{ $paket->nama_paket}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Jenis Kendaraan</label>
                                            <select name="kendaraan_id" class="form-control @error('kendaraan_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Jenis Kendaraan --</option>
                                                @foreach ($kendaraans as $kendaraan)
                                                    <option value="{{ $kendaraan->id}}">{{ $kendaraan->jenis_kendaraan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('transaksi.index')}}" class="btn btn-success">History</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
