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
                            <form action="{{ route('store_absensi',$karyawan->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="karyawan_id" value="{{ $karyawan->id}}">
                                <div class="form-group">
                                    <label for="">Tanggal Absensi</label>
                                    <input type="date" name="tanggal_absensi" class="form-control @error('tanggal_absensi') is-invalid @enderror" value="{{ old('tanggal_absensi')}}" required autofocus>
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
                                        <option value="pagi" {{ (old('shift') == 'pagi' ? 'selected':'')}}>PAGI</option>
                                        <option value="sore" {{ (old('shift') == 'sore' ? 'selected':'')}}>SORE</option>
                                        <option value="malam" {{ (old('shift') == 'malam' ? 'selected':'')}}>MALAM</option>
                                    </select>
                                    @error('shift')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Pendapatan</label>
                                    <input type="number" name="pendapatan" class="form-control @error('pendapatan') is-invalid @enderror" value="{{ old('pendapatan')}}">
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
