@extends('admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{ $title }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="total-revenue-chart"></div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1">Rp.<span data-plugin="counterup">{{ $totaltransaction }}</span></h4>
                        <p class="text-muted mb-0">Total Transaksi</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="orders-chart"> </div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1">Rp.<span data-plugin="counterup">{{ $totalpesanan }}</span></h4>
                        <p class="text-muted mb-0">total Pesanan</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="customers-chart"> </div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $totalproducts }}</span></h4>
                        <p class="text-muted mb-0">Total Products</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">

            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="growth-chart"></div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1">+ <span data-plugin="counterup">{{ $totaluser }}</span></h4>
                        <p class="text-muted mb-0">Total User</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-12 m-2">
            <div class="" id="chartPesanan">
            </div>
        </div>
        <div class="col-12 m-2">
            <div class="" id="chartPesanan">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Newest Users</h4>

                    <div data-simplebar style="max-height: 339px;">
                        <div class="table-responsive">
                            <table class="table table-borderless table-centered table-nowrap">
                                <tbody>
                                    @if ($userterbaru)
                                        @foreach ($userterbaru as $item)
                                            <tr>
                                                <td style="width: 20px;"><img src="/assets/images/users/avatar-{{rand(1, 8)}}.jpg"
                                                        class="avatar-xs rounded-circle " alt="..."></td>
                                                <td>
                                                    <h6 class="font-size-15 mb-1 fw-normal">{{$item->name}}</h6>
                                                    <p class="text-muted font-size-13 mb-0"><i
                                                            class="mdi mdi-email"></i>
                                                        {{$item->email}}</p>
                                                </td>
                                                <td><span class="badge bg-soft-{{$item->level == "user" ? "primary" : ($item->level == "kasir" ? "info" : ($item->level == "admin" ? "success" : ($item->level == "manager" ? "warning" : "") ) )}} font-size-12">{{$item->level}}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                </tbody>
                            </table>
                        </div> <!-- enbd table-responsive-->
                    </div> <!-- data-sidebar-->
                </div><!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Newest Orders</h4>

                    <table class="table table-borderless table-centered table-nowrap">
                        <tr>
                            <th>Kode</th>
                            <th>Pemesan</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($pesananterbaru as $item)
                            <tr>
                                <td>{{$item->kode_pesanan}}</td>
                                <td>{{$item->nama_pemesan}}</td>
                                <td><?= number_format($item->total_harga, 0, ',', '.');?></td>
                                <td>{{$item->status}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Newest Transaction</h4>

                    <table class="table table-borderless table-centered table-nowrap">
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($transactionterbaru as $item)
                            <tr>
                                <td>{{$item->pesanan->kode_pesanan}}</td>
                                <td><?= number_format($item->total_bayar, 0, ',', '.');?></td>
                                <td>{{$item->status}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('chartPesanan', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Sales Data'
            },
            xAxis: {
                categories: {!!$categories!!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Harga'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp.{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Total Pesanan',
                data:{!!$data!!}

            }]
        });
    </script>
@endsection
