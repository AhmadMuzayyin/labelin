@extends('layouts.masterBackEnd')
@section('title', 'Dashboard')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="col-md-3">
                <div class="widget widget-stats bg-teal">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-store fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">PARTNER</div>
                        <div class="stats-number">{{ $totalPartner }} DATA</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">PARTNER BISNIS</div>
                        <div class="stats-number">{{ $totalBusiness }} DATA</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget widget-stats bg-indigo">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-cube fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">PARTNER PRODUK</div>
                        <div class="stats-number">{{ $totalProduct }} DATA</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-2">
            <div class="widget widget-stats bg-secondary">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-circle fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">Category</div>
                    <div class="stats-number">{{ $totalCategory }} DATA</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div> --}}

            <div class="col-md-3">
                <div class="widget widget-stats bg-gray-900">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-book fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">REQUEST QR</div>
                        <div class="stats-number">{{ $totalRequestQr }} DATA</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3>Filter Data</h3>
                <hr>
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start-date">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start-date" name="start_date"
                                    value="{{ request()->get('start_date') ? request()->get('start_date') : '' }}" required>
                                @error('start_date')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end-date">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end-date" name="end_date"
                                    value="{{ request()->get('end_date') ? request()->get('end_date') : '' }}" required>
                                @error('end_date')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="action" class="d-block">Action</label>
                            <button type="submit" class="btn btn-primary" id="action">Submit</button>
                            <a href="/panel" class="btn btn-secondary">Clear</a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Total scan data --}}
            <div class="col-md-6 mt-2">
                <div class="note note-primary">
                    <div class="note-content">
                        <center>
                            <h5><b>
                                    @if (request()->get('start_date'))
                                        Total Scan Produk Dari
                                        <br>
                                        {{ date('d/m/Y', strtotime(request()->get('start_date'))) .
                                            ' - ' .
                                            date('d/m/Y', strtotime(request()->get('end_date'))) }}
                                    @else
                                        Total scanned
                                    @endif
                                </b>
                            </h5>
                            <h3 class="text-center fw-bold" style="font-size: 50px">
                                {{ $totalProductScanned }} Data
                            </h3>
                        </center>
                    </div>
                </div>
            </div>
            {{-- Scan data by gender --}}
            <div class="col-md-6 mt-2" style="color:white">
                <div class="note note-primary">
                    <div class="note-content">
                        <center>
                            <h5><b>
                                    @if (request()->get('start_date'))
                                        Scan Produk By Jenis Kelamin Dari
                                        <br>
                                        {{ date('d/m/Y', strtotime(request()->get('start_date'))) .
                                            ' - ' .
                                            date('d/m/Y', strtotime(request()->get('end_date'))) }}
                                    @else
                                        Scan Produk By Jenis Kelamin
                                    @endif
                                </b></h5>
                            <h3 class="text-center fw-bold" style="font-size: 24px">
                                @if (isset($totalGender[0]->total_gender))
                                    Laki-laki : {{ $totalGender[0]->total_gender }} Data <br>
                                @else
                                    Laki-laki : 0 Data <br>
                                @endif

                                @if (isset($totalGender[1]->total_gender))
                                    Perempuan : {{ $totalGender[1]->total_gender }} Data <br>
                                @else
                                    Perempuan : 0 Data <br>
                                @endif


                            </h3>
                        </center>
                    </div>
                </div>
            </div>
            {{-- Top Duplicate scan data --}}
            <div class="col-md-12 mt-2" style="color:white">
                <div class="note note-primary">
                    <div class="note-content">
                        <center>
                            <h5>
                                <b>Duplicate Scan</b>
                            </h5>
                            @foreach ($topDuplicate as $item)
                                @if ($item['status'] == false)
                                    <h3 class="text-center fw-bold" style="font-size: 24px">
                                        {{ $item['serial_number'] }} -
                                        {{ $item['nama_produk'] }} - {{ $item['jml_scan'] }}
                                        <form action="{{ route('customer.kunci') }}" method="post" class="d-inline">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="id" value="{{ $item['id_qrcode'] }}">
                                            <input type="hidden" name="status" value="{{ $item['status'] }}">
                                            <button
                                                class="btn btn-sm {{ $item['status'] == false ? 'btn-warning' : 'btn-success' }} btn-sm">
                                                <i class="fa-solid fa-lock-open"></i>
                                            </button>
                                        </form>
                                    </h3>
                                @endif
                            @endforeach
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-2">
                <div class="col-xl-12 ui-sortable">
                    <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                        <div class="panel-heading ui-sortable-handle">
                            @if (request()->get('start_date'))
                                <h4 class="panel-title">Map Persebaran Produk Scan Dari
                                    {{ date('d/m/Y', strtotime(request()->get('start_date'))) .
                                        ' - ' .
                                        date('d/m/Y', strtotime(request()->get('end_date'))) }}
                                </h4>
                            @else
                                <h4 class="panel-title">Map Persebaran Produk Scan</h4>
                            @endif

                        </div>
                        <div class="panel-body">
                            <div id="map-canvas" class="col-sm-12" style="height:550px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-2">
                <div class="col-xl-12 ui-sortable">
                    <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                        <div class="panel-heading ui-sortable-handle">
                            <h4 class="panel-title">Chart By Kategori</h4>
                        </div>
                        <div class="panel-body">
                            <script src="https://code.highcharts.com/highcharts.js"></script>
                            <script src="https://code.highcharts.com/modules/data.js"></script>
                            <script src="https://code.highcharts.com/modules/drilldown.js"></script>
                            <script src="https://code.highcharts.com/modules/exporting.js"></script>
                            <script src="https://code.highcharts.com/modules/export-data.js"></script>
                            <script src="https://code.highcharts.com/modules/accessibility.js"></script>

                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="col-xl-12 ui-sortable">
                    <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                        <div class="panel-heading ui-sortable-handle">
                            <h4 class="panel-title">Chart By Bisnis</h4>
                        </div>
                        <div class="panel-body">
                            <figure class="highcharts-figure">
                                <div id="container2"></div>
                            </figure>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2C2Pu928d5fXhDBBpozZY4ZKkWLbmrTY&sensor=false"></script>
    <script>
        var marker;

        function initialize() {
            // Variabel untuk menyimpan informasi (desc)
            var infoWindow = new google.maps.InfoWindow;
            //  Variabel untuk menyimpan peta Roadmap
            var mapOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            // Pembuatan petanya
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            // Variabel untuk menyimpan batas kordinat
            var bounds = new google.maps.LatLngBounds();
            // Pengambilan data dari database
            @php
                if (isset($_GET['start_date'])) {
                    $awal = $_GET['start_date'] . ' ' . '00:00:01';
                    $akhir = $_GET['end_date'] . ' ' . '23:59:59';
                    $data = DB::table('product_scanneds')
                        ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                        ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                        ->join('products', 'request_qrs.product_id', '=', 'products.id')
                        ->select('product_scanneds.*', 'products.name as nama_produk')
                        ->where('product_scanneds.created_at', '>=', $awal)
                        ->where('product_scanneds.created_at', '<=', $akhir)
                        ->get();
                    foreach ($data as $row) {
                        $nama = $row->nama_produk;
                        $lat = $row->lat;
                        $lon = $row->long;
                        echo "addMarker($lat, $lon, '<b>$nama</b>');\n";
                    }
                } else {
                    $data = DB::table('product_scanneds')
                        ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                        ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                        ->join('products', 'request_qrs.product_id', '=', 'products.id')
                        ->select('product_scanneds.*', 'products.name as nama_produk')
                        ->get();
                    foreach ($data as $row) {
                        $nama = $row->nama_produk;
                        $lat = $row->lat;
                        $lon = $row->long;
                        echo "addMarker($lat, $lon, '<b>$nama</b>');\n";
                    }
                }
                
            @endphp
            // Proses membuat marker
            function addMarker(lat, lng, info) {
                var lokasi = new google.maps.LatLng(lat, lng);
                bounds.extend(lokasi);
                var marker = new google.maps.Marker({
                    map: map,
                    position: lokasi
                });
                map.fitBounds(bounds);
                bindInfoWindow(marker, map, infoWindow, info);
            }
            // Menampilkan informasi pada masing-masing marker yang diklik
            function bindInfoWindow(marker, map, infoWindow, html) {
                google.maps.event.addListener(marker, 'click', function() {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>


    <script>
        // Create the chart
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: ''
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total scan'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.0f}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
            },

            @php
                if (isset($_GET['start_date'])) {
                    $awal = $_GET['start_date'] . ' ' . '00:00:01';
                    $akhir = $_GET['end_date'] . ' ' . '23:59:59';
                    $data_kategori = DB::table('product_scanneds')
                        ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                        ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                        ->join('products', 'request_qrs.product_id', '=', 'products.id')
                        ->join('businesses', 'products.business_id', '=', 'businesses.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select(DB::raw('count(*) as num'), 'categories.name as nama_kategori')
                        ->where('product_scanneds.created_at', '>=', $awal)
                        ->where('product_scanneds.created_at', '<=', $akhir)
                        ->groupBy('categories.name')
                        ->get();
                } else {
                    $data_kategori = DB::table('product_scanneds')
                        ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                        ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                        ->join('products', 'request_qrs.product_id', '=', 'products.id')
                        ->join('businesses', 'products.business_id', '=', 'businesses.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select(DB::raw('count(*) as num'), 'categories.name as nama_kategori')
                        ->groupBy('categories.name')
                        ->get();
                }
            @endphp

            series: [{
                name: "Bisnis",
                colorByPoint: true,
                data: [
                    @php
                        foreach ($data_kategori as $row) {
                            echo "{name: '$row->nama_kategori',y: $row->num},";
                        }
                    @endphp
                ]
            }],

        });
    </script>

    <script>
        // Create the chart
        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: ''
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total scan'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.0f}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
            },

            @php
                if (isset($_GET['start_date'])) {
                    $awal = $_GET['start_date'] . ' ' . '00:00:01';
                    $akhir = $_GET['end_date'] . ' ' . '23:59:59';
                    $data_bisnis = DB::table('product_scanneds')
                        ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                        ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                        ->join('products', 'request_qrs.product_id', '=', 'products.id')
                        ->join('businesses', 'products.business_id', '=', 'businesses.id')
                        ->select(DB::raw('count(*) as num'), 'businesses.name as nama_bisnis')
                        ->where('product_scanneds.created_at', '>=', $awal)
                        ->where('product_scanneds.created_at', '<=', $akhir)
                        ->groupBy('businesses.name')
                        ->get();
                } else {
                    $data_bisnis = DB::table('product_scanneds')
                        ->select(DB::raw('count(*) as num'))
                        ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
                        ->join('request_qrs', 'qr_codes.request_qr_id', '=', 'request_qrs.id')
                        ->join('products', 'request_qrs.product_id', '=', 'products.id')
                        ->join('businesses', 'products.business_id', '=', 'businesses.id')
                        ->select(DB::raw('count(*) as num'), 'businesses.name as nama_bisnis')
                        ->groupBy('businesses.name')
                        ->get();
                }
            @endphp
            series: [{
                name: "Bisnis",
                colorByPoint: true,
                data: [
                    @php
                        foreach ($data_bisnis as $row) {
                            echo "{name: '$row->nama_bisnis',y: $row->num},";
                        }
                    @endphp
                ]
            }],

        });
    </script>
@endpush
