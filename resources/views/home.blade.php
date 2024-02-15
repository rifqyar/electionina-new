@extends('layouts.app')
@section('title')
    HOME
@endsection

@section('content')
<div id="app">
    <div id="main">
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        
                        <div class="col-6 col-lg-2 col-md-4" >
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <h3 class="text-muted font-semibold">DAPIL</h3>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="form-group">
                                                @foreach ($kecamatan as $valcamat)
                                                   
                                                    <h6 class="mb-0 ms-3">Provinsi : {{ $valcamat->provinsi }}</h6>
                                                    <h6 class="mb-0 ms-3">Kota : {{ $valcamat->kota_kabupaten }}</h6>
                                                @endforeach
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-6 col-lg-2 col-md-4">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <h3 class="text-muted font-semibold">PARTAI</h3>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="form-group">
                                                <select class="choices form-select" id="partai_id" name="partai_id">
                                                    <option value="0">Pilih Partai</option>
                                                    @foreach ($partai as $valpartai)
                                                        <option value="{{ $valpartai->id_partai }}">{{ $valpartai->name_partai }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2 col-md-4" >
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <h3 class="text-muted font-semibold">KECAMATAN</h3>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="form-group">
                                                  <select class="choices form-select" name="kecamatan_id" id="kecamatan_id">
                                                        <option value="square">Pilih Kecmatan</option>
                                                        @foreach ($kecamatanList as $valcamatList)
                                                            <option value="{{ $valcamatList->idcamat }}">{{ $valcamatList->namacamat }}</option>
                                                        @endforeach
                                                    </select>
                                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2 col-md-4">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <h3 class="text-muted font-semibold">DESA</h3>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="form-group">
                                                <select class="choices form-select" id="selectDesa" name="selectDesa">
                                                    <option value="square">Pilih Desa</option>
                                                    {{-- @foreach ($desa as $valdesa)
                                                        <option value="{{ $valdesa->iddesa }}">{{ $valdesa->namadesa }} </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2 col-md-4">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <h3 class="text-muted font-semibold">TPS</h3>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="form-group">
                                                <select class="choices form-select" id="selectTps">
                                                    <option value="square">Pilih Tps</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2 col-md-4 ">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <h3 class="text-muted font-semibold">CALEG</h3>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="form-group">
                                                <select class="choices form-select" id="caleg_id" name="caleg_id">
                                                    <option value="square">Pilih Caleg</option>
                                                    @foreach ($caleg as $valcaleg)
                                                        <option value="{{ $valcaleg->id_caleg }}">{{ $valcaleg->name_caleg }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2 col-md-4 " hidden>
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="form-group">
                                                <h3 class="text-muted font-semibold">TOTAL   SUARA</h3>
                                                <h4 class="text-muted font-semibold">900</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <section class="section">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Bar Grafik</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="bar"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" hidden>
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Line Chart</h4>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="line"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="dataModalLabel">Peringatan</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p id="modalMessage">Tidak ada data yang tersedia untuk ditampilkan.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                      </div>
                    </div>
                  </div>
                
            </section>
        </div>
    </div>
</div>
<script src="{{'assets/extensions/choices.js/public/assets/scripts/choices.js'}}"></script>
<script src="{{'assets/extensions/chart.js/Chart.min.js'}}"></script>
<script src="{{'assets/js/pages/ui-chartjs.js'}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kecamatan_id').on('change', function() {
            var kecamatan_id = $(this).val();
            $('#selectDesa').empty();
            $('#selectDesa').append($('<option>', {
                value: 'square',
                text: 'Pilih Desa'
            }));
            $.ajax({
                url: '/get-desa', // Ganti dengan URL Anda
                type: 'GET',
                data: {
                    kecamatan: kecamatan_id
                },
                success: function(response) {
                    var desa = response.desa;
                    $.each(desa, function(key, value) {
                        $('#selectDesa').append($('<option>', {
                            value: value.iddesa,
                            text: value.namadesa
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
                    idtps: selectedDesa
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

// Di dalam file JavaScript Anda
$(document).ready(function() {
    // Fungsi untuk mengambil data dari server dan memperbarui Bar Chart
    function fetchData(partaiId, kecamatan_id,desa,tpsId, calegId) {
        $.ajax({
            url: '/load-chart-data', // Ganti URL ini dengan URL endpoint di Controller Laravel Anda
            method: 'GET',
            data: {
                partai_id: partaiId,
                kecamatan_id:kecamatan_id,
                desa:desa,
                tps: tpsId,
                caleg_id: calegId
            },
            success: function(response) {
                // Memperbarui Bar Chart dengan data yang diterima dari server
                if (response.data.labels && response.data.values && response.data.labels.length > 0 && response.data.values.length > 0) {
                // Jika ada data, perbarui Bar Chart
                updateBarChart(response.data.labels, response.data.values);
                } else {
                    // Jika tidak ada data, lakukan penanganan sesuai kebutuhan, misalnya, munculkan pesan peringatan
                    $('#modalMessage').text("Tidak ada data yang tersedia untuk ditampilkan.");
                    $('#dataModal').modal('show');
                }
               
            },
            error: function(xhr, status, error) {
                console.error(error);
            // Tampilkan modal pesan kesalahan
                $('#modalMessage').text("Terjadi  kesalahan saat memuat data.");
                $('#dataModal').modal('show');
            }
        });
    }
   // Fungsi untuk memperbarui Bar Chart
    // Fungsi untuk memperbarui Bar Chart
    function updateBarChart(labels, values) {
        // Ambil elemen canvas Bar Chart
        var ctx = document.getElementById('bar').getContext('2d');

        // Hapus Bar Chart yang sudah ada jika ada
        if (window.barChart != null) {
            window.barChart.destroy();
        }
        
        
        // Buat Bar Chart baru dengan data yang diterima
        window.barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Label untuk sumbu x (nama partai)
                datasets: [{
                    label: 'Total Suara', // Label untuk dataset
                    data: values, // Nilai untuk dataset
                    name:labels,
                    backgroundColor: function(context) {
                        var label = context.dataset.name[context.dataIndex];
                        // Menentukan warna berdasarkan nilai
                        return chartColors.blue;
                    },
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                barRoundness: 5, // Mengatur kebulatan sudut batang
                title: {
                    display: true,
                    text: "Grafik Total Suara"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 40 + 20,
                            padding: 10,
                        },
                        gridLines: {
                            display: true,
                            color: "rgba(0, 0, 0, 0.8)" // Warna gridlines yang lebih ringan
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                },
                animation: {
                    duration: 1000, // Durasi animasi 1 detik saat grafik dimuat
                    easing: 'easeInOutQuart' // Efek animasi
                },
                tooltips: {
                    enabled: true, // Aktifkan tooltip
                    backgroundColor: 'rgba(0, 0, 0, 0.8)', // Warna latar belakang tooltip
                    titleFontColor: '#ffffff', // Warna teks judul tooltip
                    bodyFontColor: '#ffffff' // Warna teks konten tooltip
                },
                // Mengatur lebar bar
                barThickness: 'flex', // Untuk lebar bar fleksibel
                // barThickness: 20, // Untuk lebar bar tetap
            }
        });


    }


    // Ketika salah satu select option berubah
    $('#partai_id, #kecamatan_id,#selectDesa,#selectTps, #caleg_id').change(function() {
        var partaiId = $('#partai_id').val();
        var kecamatan_id = $('#kecamatan_id').val();
        var desa = $('#selectDesa').val();
        var tpsId = $('#selectTps').val();
        var calegId = $('#caleg_id').val();
        fetchData(partaiId, kecamatan_id,desa,tpsId, calegId);
    });
});


</script>

@endsection
