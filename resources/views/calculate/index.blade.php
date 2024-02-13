@extends('layouts.app')
@section('title')
    HOME
   
@endsection

@section('content')
<div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
    
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Vote Caleg  </h3>
                    
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Calculate</li>
                            </ol>
                        </nav>
                        
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Data Vote Caleg
                    </div>
                    <div class="card-header">
                     
                   
                            {{-- @if ($message = Session::get('message'))
                                <div class="alert alert-success alert-dismissible show fade" style="margin-top: 10px">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif --}}

                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Partai</th>
                                    <th>Nama Caleg</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>TPS</th>
                                    <th>Total Suara</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $header)
                                    <tr>
                                        <td>{{ $header->name_partai }}</td>
                                        <td>{{ $header->name_caleg }}</td>
                                        <td>{{ $header->nama_kecamatan }}</td>
                                        <td>{{ $header->nama_desa }}</td>
                                        <td>{{ $header->name_tps }}</td>
                                        <td>{{ $header->total_suara }}</td>
                                        
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            
        </div>
</div>

@endsection
@push('after-script')
<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="assets/js/pages/datatables.js"></script>


@endpush