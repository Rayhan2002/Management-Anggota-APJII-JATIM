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
                                <li class="breadcrumb-item active" aria-current="page">{{ __('List Anggota') }}</li>
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
                        <h3 class="mb-0">{{ __('List Anggota') }}</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($data_anggota as $key => $data)<br>
                        {{ $key }} : {{ count($data) }} Anggota <br>
                        <center>
                            @foreach ($data as $img)

                                <img src="{{ asset('storage/'.$img['image']) }}" alt="" style="width:150px;">

                            @endforeach
                        </center>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        @include('nav.footer')
        @include('anggota.script')
    </div>
@endsection
