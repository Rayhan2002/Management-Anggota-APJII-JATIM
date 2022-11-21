@section('title', '| Anggota - Edit')
@extends('layouts.main')
@section('content')
@php
    $jenis_izin = json_decode($anggota->jenis_izin);
    $media = json_decode($anggota->media);
@endphp
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
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Anggota') }}</li>
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
                        <h3 class="mb-0">{{ __('Edit Anggota') }}</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('anggotas.update', $anggota) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- <input type="hidden" name="id" value="{{ $anggota->id }}"> --}}
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Nomer Registrasi') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="noreg" placeholder="Nomer Registrasi"
                                        type="number" value="{{ $anggota->noreg }}" required>
                                </div>
                                @error('noreg')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Nama Perusahaan') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="nama_per" placeholder="Nama Perusahaan"
                                        type="text" value="{{ $anggota->nama_per }}" required>
                                </div>
                                @error('nama_per')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Nama Brand') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="nama_brand" placeholder="Nama Brand"
                                        type="text" value="{{ $anggota->nama_brand }}" required>
                                </div>
                                @error('nama_brand')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Jenis Perizinan') }}<span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_izin[]" value="ISP" {{ in_array('ISP',$jenis_izin)? 'checked':'' }}>
                                        <label class="form-check-label">ISP</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_izin[]" value="NAP" {{ in_array('NAP',$jenis_izin)? 'checked':'' }}>
                                        <label class="form-check-label">NAP</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_izin[]" value="JTL" {{ in_array('JTL',$jenis_izin)? 'checked':'' }}>
                                        <label class="form-check-label">JTL</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_izin[]" value="JTT" {{ in_array('JTT',$jenis_izin)? 'checked':'' }}>
                                        <label class="form-check-label">JTT</label>
                                    </div>
                                @error('jenis_izin')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Berkantor Pusat di JATIM') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pusat" value="lokal" {{ ($anggota->pusat=="lokal")? "checked" : ""}}>
                                        <label class="form-check-label">Lokal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pusat" value="cabang" {{ ($anggota->pusat=="cabang")? "checked" : ""}}>
                                        <label class="form-check-label">Cabang</label>
                                    </div>
                                </div>
                                @error('pusat')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Media') }}<span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="media[]" value="V-SAT" {{ in_array('V-SAT',$media)? 'checked':'' }}>
                                        <label class="form-check-label">V-SAT</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="media[]" value="Fiber Optic" {{ in_array('Fiber Optic',$media)? 'checked':'' }}>
                                        <label class="form-check-label">Fiber Optic</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="media[]" value="Microwafe" {{ in_array('Microwafe',$media)? 'checked':'' }}>
                                        <label class="form-check-label">Microwafe</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="isChecked" name="media[]" value="Wireless" {{ in_array('Wireless',$media)? 'checked':'' }}>
                                        <label class="form-check-label">Wireless</label>
                                        <div class="form-group" id="txt" style="display:none;">
                                            <div class="input-group input-group-merge">
                                                <input class="form-control form-control" name="jenis_wireless" placeholder="Jenis Wireless"
                                                type="text">
                                            </div>
                                        </div>
                                    </div>
                                @error('media')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Coverage Jaringan') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="coverage" placeholder="Coverage Jaringan"
                                        type="text" value="{{ $anggota->coverage }}" required>
                                </div>
                                @error('coverage')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Alamat Lengkap') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <textarea class="form-control form-control" name="alamat" rows="3" placeholder="Alamat Lengkap">{{ $anggota->alamat }}</textarea>
                                </div>
                                @error('alamat')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Provinsi') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <select class="form-control" id="provinces" data-toggle="select" name="provinces" required>
                                        <option value="" selected>Select Provinsi ...</option>
                                        <option value="{{ $provinces->id="35" }}">{{ $provinces->name="JAWA TIMUR" }}</option>
                                    </select>
                                </div>
                                @error('provinces')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Kabupaten') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <select class="form-control" id="regencies" data-toggle="select" name="regencies" required>
                                        <option value="" selected>Select Kabupaten ...</option>
                                    </select>
                                </div>
                                @error('regencies')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Kecamatan') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <select class="form-control" id="districts" data-toggle="select" name="districts" required>
                                        <option value="" selected>Select Kecamatan ...</option>
                                    </select>
                                </div>
                                @error('districts')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Kelurahan') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <select class="form-control" id="villages" data-toggle="select" name="villages" required>
                                        <option value="" selected>Select Kelurahan ...</option>
                                    </select>
                                </div>
                                @error('villages')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('RT') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="rt" placeholder="RT"
                                        type="text" value="{{ $anggota->rt }}" required>
                                </div>
                                @error('rt')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('RW') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="rw" placeholder="RW"
                                        type="text" value="{{ $anggota->rw }}" required>
                                </div>
                                @error('rw')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Kode Pos') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="kode_pos" placeholder="Kode Pos"
                                        type="text" value="{{ $anggota->kode_pos }}" required>
                                </div>
                                @error('kode_pos')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Nama Perwakilan 1') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="pic" placeholder="Nama Perwakilan"
                                        type="text" value="{{ $anggota->pic }}" required>
                                </div>
                                @error('pic')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Nomer Whatsapp') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="wa" placeholder="Nomer Whatsapp"
                                        type="text" value="{{ $anggota->wa }}" required>
                                </div>
                                @error('wa')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Email') }}<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="email" placeholder="Email"
                                        type="email" value="{{ $anggota->email }}" required>
                                </div>
                                @error('email')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Nama Perwakilan 2') }}</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="pic2" placeholder="Nama Perwakilan"
                                        type="text" value="{{ $anggota->pic2 }}">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Nomer Whatsapp') }}</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="wa2" placeholder="Nomer Whatsapp"
                                        type="text" value="{{ $anggota->wa2 }}">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Email') }}</label>
                                <div class="input-group input-group-merge">
                                    <input class="form-control form-control" name="email2" placeholder="Email"
                                        type="email" value="{{ $anggota->email2 }}">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-control-label">{{ __('Ganti Logo') }}</label>
                                <div class="custom-file">
                                    <input type="hidden" name="oldImage" id="oldImage" value="{{ $anggota->image }}">
                                    @if($anggota->image)
                                        <center><img src="{{ asset('storage/'.$anggota->image) }}" class="img-preview img-fluid mt-6 col-sm-3 d-block"></center>
                                    @else
                                        <center><img class="img-preview img-fluid mt-6 col-sm-3 d-block"></center>
                                    @endif
                                    <input type="file" class="custom-file-input" id="image" lang="en" accept="image/*" 
                                        name="image" onchange="previewImage()">
                                    <label class="custom-file-label" for="image"></label>
                                </div>
                            </div>
                            <a href="{{ route('anggotas.index') }}" class="btn btn-default"
                                type="submit">{{ __('Back') }}</a>
                            <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('nav.footer')
    </div>

@endsection
