@extends('layouts.main')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{ __('Anggota') }}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home text-white"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('anggotas.index') }}"
                                        class="text-white">{{ __('Anggota') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('View Anggota') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">{{ __('View Anggota') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-1">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                Nomer Registrasi<br>
                                Nama Perusahaan<br>
                                Nama Brand<br>
                                Jenis Perizinan<br>
                                Berkantor Pusat Di<br>
                                Media<br>
                                Jenis Wireless<br>
                                Coverage Jaringan<br>
                                Alamat Lengkap<br>
                                Provinsi<br>
                                Kabupaten/Kota<br>
                                Kecamatan<br>
                                Kelurahan<br>
                                RT/RW<br>            
                                Kode Pos<br>
                                Nama Perwakilan 1<br>
                                Nomer Whatsapp<br>   
                                Email<br>
                                Nama Perwakilan 2<br>
                                Nomer Whatsapp<br>   
                                Email<br>
                                Logo :<br>
                                <img src="{{ asset('storage/'.$anggota['image']) }}" id="img" alt="" style="width:150px;">
                                </div>

                                <div class="col-sm-4 invoice-col">
                                : {{ $anggota->noreg }}<br>
                                : {{ $anggota->nama_per }}<br>
                                : {{ $anggota->nama_brand }}<br>
                                :
                                @php
                                $jenis_izin = json_decode($anggota->jenis_izin)
                                @endphp
                                @foreach ($jenis_izin as $izin)
                                    {{ $izin }},
                                @endforeach
                                <br>
                                : {{ $anggota->pusat }}<br>
                                :
                                @php
                                $media = json_decode($anggota->media)
                                @endphp
                                @foreach ($media as $med)
                                    {{ $med }},
                                @endforeach
                                <br>
                                : {{ $anggota->jenis_wireless }}<br>
                                : {{ $anggota->coverage }}<br>
                                : {{ $anggota->alamat }}<br>
                                : {{ $anggota->province->name }}<br>
                                : {{ $anggota->regency->name }}<br>
                                : {{ $anggota->district->name }}<br>
                                : {{ $anggota->village->name }}<br>
                                : {{ $anggota->rt }} / {{ $anggota->rw }}<br>
                                : {{ $anggota->kode_pos }}<br>
                                : {{ $anggota->pic }}<br>
                                : {{ $anggota->wa }}<br>
                                : {{ $anggota->email }}<br>
                                : {{ $anggota->pic2 }}<br>
                                : {{ $anggota->wa2 }}<br>
                                : {{ $anggota->email2 }}<br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Footer -->
        @include('nav.footer')
        @include('participant.script')
    </div>
@endsection
