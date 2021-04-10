@extends('layouts.back-main')

@section('title','Edit Data Kendaraan')

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
                                Edit Kendaraan
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kendaraan.update',$kendaraan->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="">Nama kendaraan</label>
                                    <input type="text" name="jenis_kendaraan" class="form-control @error('jenis_kendaraan') is-invalid @enderror" value="{{ $kendaraan->jenis_kendaraan}}" required autofocus>
                                    @error('jenis_kendaraan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('kendaraan.index')}}" class="btn btn-secondary">Kembali</a>
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
