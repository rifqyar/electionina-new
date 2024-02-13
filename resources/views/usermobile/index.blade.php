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
                        <h3>Data User Mobile</h3>
                    
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Mobile</li>
                            </ol>
                        </nav>
                        
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Data Tps
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Di buat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $header)
                                    <tr>
                                        <td>{{ $header->usernameMobile }}</td>
                                        <td>{{ $header->email }}</td>
                                        <td class="hidetext">{{ $header->password }}</td>
                                        <td>{{ $header->updated_at }}</td>
                                        <td>
                                            <a class="passingID2 btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#default"
                                            data-iduser="{{ $header->iduserMobile }}"
                                            data-namauser="{{ $header->usernameMobile }}"
                                            data-passwordser="{{ $header->password }}"
                                            data-email="{{ $header->email }}">
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
                            <h4 class="modal-title" id="myModalLabel33">Tambah User Mobile </h4>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('usermobile.create') }}" onsubmit="validateForm()" method="POST" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="modal-body">
                                <label>Nama User</label>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" placeholder="Nama User"
                                        class="form-control">
                                </div>
                                <label>Email User</label>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" placeholder="Email User"
                                        class="form-control">
                                </div>
                                <label>Password</label>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" placeholder="Password"
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
                            <h5 class="modal-title" id="myModalLabel1">Edit User Mobile</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('usermobile.update') }}" onsubmit="validateForm()" method="POST" enctype="multipart/form-data" id="formedit">
                            @csrf
                            <div class="modal-body">
                                <label>Nama User </label>
                                <div class="form-group">
                                    <input type="text" name="nameuserx" id="nameuserx" placeholder="Nama User"class="form-control">
                                </div>
                                <input hidden type="text" name="iduserx" id="iduserx" placeholder="id usermobile"class="form-control">
                                <label>Email User</label>
                                    <div class="form-group">
                                        <input type="email" name="emailx" id="emailx" placeholder="Email User"
                                            class="form-control">
                                    </div>
                                <label>Password</label>
                                    <div class="form-group">
                                        <input type="password" name="passwordx" id="passwordx" placeholder="Password"
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
    
    $(document).on("click", ".passingID2", function () {
        var iduser = $(this).data('iduser'); 
        var namauser = $(this).data('namauser');
        var password = $(this).data('passwordser');
        var email = $(this).data('email');
        // Set the content of th elements
        $("#iduserx").val(iduser);
        $("#nameuserx").val(namauser);
        $("#passwordx").val(password);
        $("#emailx").val(email);

        // data-iduser="{{ $header->iduserMobile }}"
        //                                     data-namauser="{{ $header->usernameMobile }}"
        //                                     data-passwordser="{{ $header->password }}"
        //                                     data-email="{{ $header->email }}">
        
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
            var name = document.getElementById("username").value;
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