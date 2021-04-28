@extends('layouts.front-main')

@section('title','Biodata')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="text-center">BIODATA ANDA</h5>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Updated!</strong> {{$message}}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('biodata.update')}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" value="{{ $karyawan->nama_karyawan}}" required>
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
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
