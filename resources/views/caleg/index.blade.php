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
                        <h3>Data Caleg</h3>
                    
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Caleg</li>
                            </ol>
                        </nav>
                        
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Data Caleg
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
                                    <th>Nama Caleg</th>
                                    <th>Dapil</th>
                                    <th>Nama  Partai</th>
                                    <th>Nomor Partai</th>
                                    <th>Di buat</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $header)
                                    <tr>
                                        <td>{{ $header->name_caleg }}</td>
                                        <td>{{ $header->provinsi }} - {{ $header->kota_kabupaten }}</td>
                                        <td>{{ $header->name_partai }}</td>
                                        <td>{{ $header->nomor_partai }}</td>
                                        <td>{{ $header->modified_by }}</td>
                                        <td>{{ $header->updated_at }}</td>
                                        <td>
                                            <a class="passingID8 btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#default"
                                            data-idcalegv="{{ $header->idcaleg }}"
                                            data-namecalegv="{{ $header->name_caleg }}"
                                            data-provinsiv="{{ $header->provinsi }}"
                                            data-namekotakabuv="{{ $header->kota_kabupaten }}"
                                            data-idpartaiv="{{ $header->idpartai }}">
                                            <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                          </a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->
            <!--Basic Modal -->
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Tambah Caleg </h4>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('caleg.create') }}" onsubmit="validateForm()" method="POST" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="modal-body">
                                <label>Nama Caleg </label>
                                <div class="form-group">
                                    <input type="text" name="namecaleg" id="namecaleg" placeholder="Nama Caleg"
                                        class="form-control">
                                </div>
                                <div class="form-group" >
                                    <label>Pilih Partai </label>
                                    <select class="choices form-select" id="idpartai" name="idpartai" >
                                        @foreach ($partai as $vals)
                                            <option value="{{ $vals->idpartai }}">{{ $vals->name_partai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" @readonly(true)>
                                    <label>Provinsi </label>
                                    <select class="choices form-select" id="iddapil" name="iddapil" >
                                        @foreach ($dapil as $vals)
                                            <option value="{{ $vals->iddapil }}">{{ $vals->provinsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" @readonly(true)>
                                    <label>Kota/Kabupaten </label>
                                    <select class="choices form-select" @readonly(true) >
                                        @foreach ($dapil as $vals)
                                            <option value="{{ $vals->iddapil }}">{{ $vals->kota_kabupaten }}</option>
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
            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Edit Dapil</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('caleg.update') }}" onsubmit="validateForm()" method="POST" enctype="multipart/form-data" id="formedit">
                            @csrf
                            <div class="modal-body">
                                <label>Nama Caleg </label>
                                <div class="form-group">
                                    <input type="text" name="namecalegx" id="namecalegx" placeholder="Nama Caleg"class="form-control">
                                </div>
                                <input hidden type="text" name="idcalegx" id="idcalegx" class="form-control">
                                <div class="form-group">
                                    <label>Pilih Partai </label>
                                    <select class="choices form-select" id="idpartaix" name="idpartaix">
                                        @foreach ($partai as $vals)
                                            <option value="{{ $vals->idpartai }}">{{ $vals->name_partai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Provinsi </label>
                                    <select class="choices form-select" id="iddapilx" name="iddapilx" @readonly(true)>
                                        @foreach ($dapil as $vals)
                                            <option value="{{ $vals->iddapil }}">{{ $vals->provinsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kota/Kabupaten </label>
                                    
                                        @foreach ($dapil as $vals)
                                            <input type="text" value="{{ $vals->kota_kabupaten }}" class="form-control" readonly>
                                        @endforeach
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
<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="assets/js/pages/datatables.js"></script>
<script src="assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="assets/js/pages/form-element-select.js"></script>
<script>
    
    $(document).on("click", ".passingID8", function () {
        var idcaleg = $(this).data('idcalegv'); // // Use 'id' instead of 'kolom1'
        var namecaleg = $(this).data('namecalegv');
        var provinsi = $(this).data('provinsiv');
        var namekotakabu = $(this).data('namekotakabuv');
        var namapartai = $(this).data('idpartaiv');
        // Set the content of th element
        $("#namecalegx").val(namecaleg);
        $("#provinsix").val(provinsi);
        $("#namekotakabux").val(namekotakabu);
        $("#idpartaix").val(namapartai);
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
            var name = document.getElementById("namecaleg").value;
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