@extends('layouts.back-main')

@section('title','Edit Data Karyawan')

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
                                Edit Karyawan
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('karyawan.update',$karyawan->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="">Nama Karyawan</label>
                                    <input type="text" name="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" value="{{ $karyawan->nama_karyawan}}" required autofocus>
                                    @error('nama_karyawan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                                        <option value="">-- Pilih Jabatan --</option>
                                        <option value="kasir" {{ ($karyawan->jabatan == 'kasir' ? 'selected':'')}}>KASIR</option>
                                        <option value="pencuci" {{ ($karyawan->jabatan == 'pencuci' ? 'selected':'')}}>PENCUCI</option>
                                    </select>
                                    @error('jabatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3">{{ $karyawan->alamat}}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor Telepon</label>
                                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ $karyawan->no_telp}}">
                                    @error('no_telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('karyawan.index')}}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
