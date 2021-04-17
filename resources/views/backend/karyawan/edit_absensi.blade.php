@extends('layouts.back-main')

@section('title','Tambah Data Absensi')

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
                                Tambah Absensi Karyawan
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update_absensi',[$karyawan->id,$absensi->id])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="">Tanggal Absensi</label>
                                    <input type="date" name="tanggal_absensi" class="form-control @error('tanggal_absensi') is-invalid @enderror" value="{{ \Carbon\Carbon::parse($absensi->tanggal_absensi)->format('Y-m-d')}}" required autofocus>
                                    @error('tanggal_absensi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Shift</label>
                                    <select name="shift" class="form-control @error('shift') is-invalid @enderror">
                                        <option value="">-- Pilih Shift --</option>
                                        <option value="pagi" {{ ($absensi->shift == 'pagi' ? 'selected':'')}}>PAGI</option>
                                        <option value="sore" {{ ($absensi->shift == 'sore' ? 'selected':'')}}>SORE</option>
                                        <option value="malam" {{ ($absensi->shift == 'malam' ? 'selected':'')}}>MALAM</option>
                                    </select>
                                    @error('shift')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Pendapatan</label>
                                    <input type="number" name="pendapatan" class="form-control @error('pendapatan') is-invalid @enderror" value="{{ $absensi->pendapatan}}">
                                    @error('pendapatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('karyawan.show',$karyawan->id)}}" class="btn btn-secondary">Kembali</a>
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
