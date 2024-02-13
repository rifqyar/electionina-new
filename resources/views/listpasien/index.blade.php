@extends('layouts.app')

@section('title')
HOME
@endsection


<style>
    .card-content {
        margin-top: -40px
    }
</style>

@section('content')
    <div id="app">

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
                            <h3>List Obat</h3>

                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Gate</a></li>
                                    <li class="breadcrumb-item"><a href="#">list</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Obat Pasien</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>



                <section class="section">
                    <div class="card">
                        <div class="card-header">
                    
                      
                                @if ($message = Session::get('message'))
                                <div class="alert alert-success alert-dismissible show fade" style="margin-top: 10px">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="table1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th nowrap>Action</th>
                                                <th>Pasien</th>
                                                
                                                <th>Nomor</th>
                                                <th>Obat</th>
                                                <th>Qty</th>
                                                <th>Jam</th>
                                            </tr>
                                        </thead>
                                        <?php $no = 1; ?>
                                        <tbody>
                                            @foreach ($detail as $header)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td> <a href="{{ url('/listpasien/edit/' . $header->id .'/'.$header->id_obat.'/'.$header->jam) }}"
                                                        id="btn-edit-post" class="btn btn-xs btn-primary"><i
                                                            class="fa fa-edit" title="Edit Data"></i></a>
                                                    
                                                </td>                                               
                                                <td>{{ $header->pasien }}</td>
                                                
                                                <td>{{ $header->transactionnumber }}</td>
                                                <td>{{ $header->obat_name }}</td> 
                                                <td>{{ $header->qty }}</td> 
                                                <td>{{ $header->jam }}</td>  
                               


                                                
                                        @endforeach

                                        {{-- +"id": 70
                                        +"transactionnumber": "T-0002"
                                        +"stardate": "2023-06-21"
                                        +"enddate": "2023-06-21"
                                        +"jam": "15:40:00"
                                        +"id_obat": 13
                                        +"obat_name": "Cefdinir" --}}

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>



                    </div>

                </section>


            </div>
        </div>
    </div>
@endsection

@push('after-script')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // ShowData()
            // ProjectFind()
           
            $('#exampleModal').modal({
                show: true,
                keyboard: false,
                backdrop: 'static'
            });
            $('#exampleModalV2').modal({
                show: true,
                keyboard: false,
                backdrop: 'static'
            });

        })

        $('body').on('click', '#btn-delete-post', function() {
            let id = $(this).data('id');
            var base_url = "{{ url('/Schedule/') }}";
            var get_item_url = base_url + "/delete/" + id;
            Swal.fire({
                title: 'Are You Sure?',
                text: "Delete Data !!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'NO',
                confirmButtonText: 'YES, DELETE!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //fetch to delete data
                    $.ajax({
                        type: "PUT",
                        url: get_item_url,
                        cache: false,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {

                            //show success message
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: "Delete Data Successfully",
                                showConfirmButton: false

                            });
                            window.location.reload();
                

                        }
                    });
                }
            })
        });


    </script>
   
@endpush
