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
                                <li class="breadcrumb-item active" aria-current="page">Vote</li>
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
                        Data Vote Caleg
                    </div>
                    <div class="card-header">
                        <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                            data-bs-target="#inlineForm">
                            Tambah
                        </button>
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
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Input Suara </h4>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('votecaleg.create') }}" onsubmit="validateForm()" method="POST" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="modal-body">
                               
                                <div class="form-group">
                                    <label>Pilih Partai </label>
                                    <select class="choices form-select" id="idpartaix" name="idpartaix">
                                        @foreach ($partai as $valsp)
                                            <option value="{{ $valsp->idpartai }}">{{ $valsp->name_partai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- $partai =  DB::table('partai')->select('partai.name_partai','partai.nomor_partai','partai.alamat','partai.id_partai as idpartai')->get();
                                $caleg =  DB::table('caleg')->select('caleg.id_caleg as id_caleg','caleg.name_caleg as name_caleg')->get();
                                $dapil  =  DB::table('dapil')->select('dapil.provinsi','dapil.kota_kabupaten','dapil.id as iddapil')->get();
                                $camat =  DB::table('kecamatan')->select('kecamatan.id as camatid','kecamatan.nama_kecamatan')->get();
                                $desa =  DB::table('desa')->select('desa.id as desaid','desa.nama_desa')->get();
                                $rtrw =  DB::table('rtrw')->select('rtrw.namertrw as namertrw','rtrw.id as idrtrw')->get();
                                $tps =  DB::table('tps')->select('tps.id_tps as idtps','tps.name_tps as namatps')->get(); --}}
                                <div class="form-group">
                                    <label>Provinsi </label>
                                    <select class="choices form-select" id="iddapil" name="iddapil" @readonly(true)>
                                        @foreach ($dapil as $valsdp)
                                            <option value="{{ $valsdp->iddapil }}">{{ $valsdp->provinsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kota/Kabupaten </label>
                                    
                                        @foreach ($dapil as $valskk)
                                            <input type="text" value="{{ $valskk->kota_kabupaten }}" class="form-control" readonly>
                                        @endforeach
                                </div>
                                <div class="form-group">
                                    <label>Pilih Kecamatan</label>
                                    <select class="choices form-select" id="camatx" name="camatx">
                                        @foreach ($camat as $vacmtl)
                                            <option value="{{ $vacmtl->camatid }}">{{ $vacmtl->nama_kecamatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Desa</label>
                                    <select class="choices form-select" id="selectDesa" name="selectDesa">
                                        @foreach ($desa as $valdesa)
                                            <option value="{{ $valdesa->desaid }}">{{ $valdesa->nama_desa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Tps</label>
                                    <select class="choices form-select" id="selectTps" name="selectTps">
                                        <option value="square">Pilih Tps</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Caleg</label>
                                    <select class="choices form-select" id="caleg" name="caleg">
                                        @foreach ($caleg as $valcaleg)
                                            <option value="{{ $valcaleg->id_caleg }}">{{ $valcaleg->name_caleg }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label>Input Suara </label>
                                <div class="form-group">
                                    <input type="number" name="suaracaleg" id="suaracaleg" 
                                        class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" id="btnsubmit" class="btn btn-primary ml-1"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Edit Desa</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('votecaleg.update') }}" onsubmit="validateForm()" method="POST" enctype="multipart/form-data" id="formedit">
                            @csrf
                            <div class="modal-body">
                                <label>Nama Desa </label>
                                <div class="form-group">
                                    <input type="text" name="desanamex" id="desanamex" placeholder="Nama Desa"class="form-control">
                                </div>
                                <input hidden type="text" name="iddesax" id="iddesax" placeholder="Nama desa"class="form-control">
                                <div class="form-group">
                                    <label>Pilih Keamatan</label>
                                    <select class="choices form-select" id="camatx" name="camatx">
                                        @foreach ($camat as $val)
                                            <option value="{{ $val->camatid }}">{{ $val->nama_kecamatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                           
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" id="btnsubmit" class="btn btn-primary ml-1"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
@push('after-script')
<script src="{{'assets/extensions/choices.js/public/assets/scripts/choices.js'}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#selectDesa').on('change', function() {
            var selectedDesa = $(this).val();
            $('#selectTps').empty();
            $('#selectTps').append($('<option>', {
                value: 'square',
                text: 'Pilih Tps'
            }));
            $.ajax({
                url: '/get-tps', // Ganti dengan URL Anda
                type: 'GET',
                data: {
                    iddesa: selectedDesa
                },
                success: function(response) {
                    var tps = response.tps;
                    $.each(tps, function(key, value) {
                        $('#selectTps').append($('<option>', {
                            value: value.id_tps,
                            text: 'RT ' + value.rt + '/RW ' + value.rw + ' - TPS ' + value.name_tps
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    
    $(document).on("click", ".passingID2", function () {
        var iddesa = $(this).data('iddesa'); // Us
        var idcamat = $(this).data('idcamat');
        var namadesa = $(this).data('namadesa');
        // Set the content of th elements
        $("#iddesax").val(iddesa);
        $("#camatx").val(idcamat);
        $("#desanamex").val(namadesa);
    });
</script>
<script>
    
    
   

        $('#btnsubmit').on('click', function(event) {
            event.preventDefault();
            const isFormValid = validateForm();

            if (isFormValid) {
                $(this).prop('disabled', true);
                $('body').append('<div class="overlay"><div class="spinner"></div></div>');
                $('#form').submit();

            }
        });
        function validateForm() {
            var name = document.getElementById("caleg").value;
            // console.log(name);
            // if (input == "") {
            //     alert("Input text cannot be empty!");
            //     return false;
            // }

            return true;
        }
        $('#form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var dataform = new FormData(form);
            var btnsubmit = document.getElementById("btnsubmit");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $(form).attr('action'),
                method: "POST",
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },

                success: function(res) {
                    if (res.status==200) {
                        Swal.fire({
                        icon: "success",
                        title: `${res.message}`,
                    });
                        window.location = res.url;
                    }
                    else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${res.message}`,
                        })

                        btnsubmit.disabled = false;
                    }
                    



                },
                error: function(error) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${error.message}`,
                    })

                    btnsubmit.disabled = false;


                }
            });
        });

        $('#formedit').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var dataform = new FormData(form);
            var btnsubmit = document.getElementById("btnsubmit");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $(form).attr('action'),
                method: "POST",
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },

                success: function(res) {
                    if (res.status==200) {
                        Swal.fire({
                        icon: "success",
                        title: `${res.message}`,
                    });
                        window.location = res.url;
                    }
                    else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${res.message}`,
                        })

                        btnsubmit.disabled = false;
                    }
                    



                },
                error: function(error) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${error.message}`,
                    })

                    btnsubmit.disabled = false;


                }
            });
        });
        
</script>

@endpush