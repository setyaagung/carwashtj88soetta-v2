@extends('layouts.back-main')

@section('title','Tambah Data Karyawan')

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
                                Tambah Karyawan
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('karyawan.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Karyawan</label>
                                    <input type="text" name="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" value="{{ old('nama_karyawan')}}" required autofocus>
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
                                        <option value="kasir" {{ (old('jabatan') == 'kasir' ? 'selected':'')}}>Kasir</option>
                                        <option value="pencuci" {{ (old('jabatan') == 'pencuci' ? 'selected':'')}}>Pencuci</option>
                                    </select>
                                    @error('jabatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat')}}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor Telepon</label>
                                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp')}}">
                                    @error('no_telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Konfirmasi Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('karyawan.index')}}" class="btn btn-secondary">Kembali</a>
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
