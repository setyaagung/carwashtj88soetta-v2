@extends('layouts.front-main')

@section('title','Selamat Datang Di TJ88 SOETTA')

@section('jumbotron')
    <!-- jumbotron -->
    <section class="jumbotron jumbotron-fluid a" style="height: 600px !important">
        <div class="container">
            <h3 class="animated fadeInDown delay-1s">CAR WASH TJ88<br>CABANG SOEKARNO-HATTA</h3>
            <p class="animated fadeInDown delay-1s">Jl. Soekarno Hatta No.46-50, Kalicari, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50198</p>
        </div>
    </section>
    <!-- keunggulan -->
    <div class="keunggulan text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-4">
                    <img src="{{asset('images/car-wash.png')}}" class="img-fluid" width="40%">
                    <h5 style="margin-top:10px" class="font-weight-bold">CUCI BERSIH</h5>
                    <p>Kualitas pencucian yang kami berikan sangat bersih</p>
                </div>
                <div class="col-sm-8 col-lg-4">
                    <img src="{{asset('images/service.png')}}" class="img-fluid" width="24%">
                    <h5 style="margin-top:10px" class="font-weight-bold">PELAYANAN RAMAH</h5>
                    <p>Kami sangat memperhatikan kenyamanan pelanggan saat mencucikan kendaraan</p>
                </div>
                <div class="col-sm-8 col-lg-4">
                    <img src="{{asset('images/free-wifi.png')}}" class="img-fluid" width="29%">
                    <h5 style="margin-top:10px" class="font-weight-bold">FREE WIFI</h5>
                    <p>Pelanggan bisa menikmati layanan free wifi saat sedang menunggu</p>
                </div>
            </div>
        </div>
    </div>
    <!-- kontak -->
    <section id="kontak" class="kontak">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 style="margin-top: 35px" class="font-weight-bold">Hubungi Kami</h3>
                </div>
            </div>
            <div class="row" style="margin-top:40px;">
                <div class="col-md-5">
                    <h5 class="font-weight-bold">LOKASI</h5>
                    <div class="google-maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3960.1823328794612!2d110.4536743!3d-6.9877919!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708d3779970335%3A0x5f0824b0c4cd9f7!2sCarwash%20TJ88%2024jam%20Cabang!5e0!3m2!1sid!2sid!4v1619946631963!5m2!1sid!2sid" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
                <div style="margin-left:55px;margin-right:55px;margin-top:30px"></div>
                <div class="col-md-5">
                    <h5 class="font-weight-bold">KONTAK</h5>
                    <div class="col-md">
                        <i class="fa fa-envelope float-left"></i>
                        <p>Email<br>#</p>
                    </div>
                    <div class="col-md">
                        <i class="fa fa-map float-left"></i>
                        <p>Alamat<br>Jl. Soekarno Hatta No.46-50, Kalicari, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50198</p>
                    </div>
                    <div class="col-md">
                        <i class="fa fa-phone float-left"></i>
                        <p>Phone<br>0813-2965-5860</p>
                    </div>
                    <div class="col-md">
                        <i class="fa fa-fax float-left"></i>
                        <p>Fax<br>#</p>
                    </div>
                    <p style="margin-left:20px">Sosial Media</p>
                    <div class="col-md">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
