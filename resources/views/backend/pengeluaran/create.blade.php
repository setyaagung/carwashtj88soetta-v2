@extends('layouts.back-main')

@section('title','Tambah Data Pengeluaran')

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
                                Tambah Pengeluaran
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pengeluaran.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Tanggal Pengeluaran</label>
                                    <input type="date" name="tanggal_pengeluaran" class="form-control @error('tanggal_pengeluaran') is-invalid @enderror" value="{{ date('Y-m-d')}}" required autofocus>
                                    @error('tanggal_pengeluaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pengeluaran</label>
                                    <input type="text" class="form-control @error('nama_pengeluaran') is-invalid @enderror" name="nama_pengeluaran" value="{{ old('nama_pengeluaran')}}" required>
                                    @error('nama_pengeluaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis</label>
                                    <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" onchange="return showkaryawan();" required>
                                        <option value="">-- Jenis --</option>
                                        <option value="bon">BON</option>
                                        <option value="kantor">Kantor</option>
                                    </select>
                                    @error('jenis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group" id="karyawan_id" style="display: none">
                                    <label for="">Karyawan</label>
                                    <select class="form-control @error('karyawan_id') is-invalid @enderror" name="karyawan_id" id="karyawan_id">
                                        <option value="">-- Pilih Karyawan --</option>
                                        @foreach ($data_karyawan as $karyawan)
                                            <option value="{{ $karyawan->id}}">{{ $karyawan->nama_karyawan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah')}}" required>
                                    @error('jumlah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan')}}</textarea>
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('pengeluaran.index')}}" class="btn btn-secondary">Kembali</a>
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

@push('scripts')
    <script>
        //karyawan
        function showkaryawan(){
                var selectBox = document.getElementById('jenis');
                var userInput = selectBox.options[selectBox.selectedIndex].value;
                if (userInput == 'bon')
                {
                    document.getElementById('karyawan_id').style.display = 'block';
                }else{
                    document.getElementById('karyawan_id').style.display= 'none';
                }
                return false;
            }
    </script>
@endpush
