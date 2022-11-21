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
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Anggota') }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-neutral mt-1" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="btn-inner--text">{{ __('Excel Pilih Kolom') }}</span>
                                <span class="btn-inner--icon"><i class="ni ni-bold-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <form action="anggota/export" method="GET" enctype="multipart/form-data">
                                    Pilih Kolom : <br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="nama_per">{{ __('Nama Perusahaan') }}
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="nama_brand">Nama Brand
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="jenis_izin">Jenis Perizinan
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="pusat">Pusat
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="media">Media
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="coverage">Coverage Jaringan
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="alamat">Alamat Lengkap
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="province.name">Provinsi
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="regency.name">Kabupaten/Kota
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="district.name">Kecamatan
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="village.name">Kelurahan
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="kode_pos">Kode Pos
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="pic">PIC
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="wa">NO.WA
                                        </label><br>
                                        <label>
                                            <input type="checkbox" name="columns[]" value="email">Email
                                        </label><br>
                                        <button class="btn btn-success" type="submit">
                                            Export
                                        </button>
                                </form>
                            </div>
                        </div>
                        <a href="{{ route('anggotas.create') }}" class="btn btn-sm btn-neutral">{{ __('Add Anggota') }}</a>
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
                        <h3 class="mb-0">{{ __('Daftar Anggota') }}</h3>
                    </div>
                    <div class="table-responsive py-2">
                        <table class="table table-flush" id="myTable" style="white-space:normal">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Nama Perusahaan') }}</th>
                                    <th style="text-align: center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Nama Perusahaan') }}</th>
                                    <th style="text-align: center">{{ __('Action') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($data_anggota as $anggota)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $anggota['nama_per'] }}</td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('anggotas.edit', $anggota) }}"
                                                class="btn btn-sm btn-icon btn-primary btn-icon-only rounded-circle"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><span
                                                class="btn-inner--icon"><i class="fas fa-pen-square"></i></span>
                                            </a>
                                            <a href="{{ route('anggotas.show', $anggota) }}"
                                                class="btn btn-sm btn-icon btn-primary btn-icon-only rounded-circle"
                                                data-toggle="tooltip" data-placement="top" title="View"><span
                                                class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                            </a>
                                            <button onclick="deleteItem(this)" data-id="{{ $anggota->id }}"
                                                class="btn btn-sm btn-icon btn-youtube btn-icon-only rounded-circle"
                                                data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        @include('nav.footer')
        @include('anggota.script')
    </div>
@endsection
