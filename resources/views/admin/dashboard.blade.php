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
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $totaltransaction }}</span></h4>
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
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $totalpesanan }}</span></h4>
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
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $totaluser }}</span></h4>
                        <p class="text-muted mb-0">Total User</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->

    <div class="row">

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Chart Pesanan</h4>

                    <div class="mt-3">
                        <div id="sales-analytics-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

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
                                                <td style="width: 20px;"><img
                                                        src="/assets/images/users/avatar-{{ rand(1, 8) }}.jpg"
                                                        class="avatar-xs rounded-circle " alt="..."></td>
                                                <td>
                                                    <h6 class="font-size-15 mb-1 fw-normal">{{ $item->name }}</h6>
                                                    <p class="text-muted font-size-13 mb-0"><i class="mdi mdi-email"></i>
                                                        {{ $item->email }}</p>
                                                </td>
                                                <td><span
                                                        class="badge bg-soft-{{ $item->level == 'user' ? 'primary' : ($item->level == 'kasir' ? 'info' : ($item->level == 'admin' ? 'success' : ($item->level == 'manager' ? 'warning' : ''))) }} font-size-12">{{ $item->level }}</span>
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
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Newest Products</h4>

                    <table class="table table-borderless table-centered table-nowrap">
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                        </tr>
                        @foreach ($productsterbaru as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td><?= number_format($item->harga, 0, ',', '.') ?></td>
                                <td>{{ $item->categories->nama }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
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
                                <td>{{ $item->kode_pesanan }}</td>
                                <td>{{ $item->nama_pemesan }}</td>
                                <td><?= number_format($item->total_harga, 0, ',', '.') ?></td>
                                <td>{{ $item->status }}</td>
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
                                <td>{{ $item->pesanan->kode_pesanan }}</td>
                                <td><?= number_format($item->total_bayar, 0, ',', '.') ?></td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('chart')
    <script>
        var options1 = {
                series: [{
                    data: [25, 66, 41, 89, 63, 25, 44, 20, 36, 40, 54]
                }],
                fill: {
                    colors: ["#5b73e8"]
                },
                chart: {
                    type: "bar",
                    width: 70,
                    height: 40,
                    sparkline: {
                        enabled: !0
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%"
                    }
                },
                labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                xaxis: {
                    crosshairs: {
                        width: 1
                    }
                },
                tooltip: {
                    fixed: {
                        enabled: !1
                    },
                    x: {
                        show: !1
                    },
                    y: {
                        title: {
                            formatter: function(e) {
                                return "";
                            },
                        },
                    },
                    marker: {
                        show: !1
                    },
                },
            },
            chart1 = new ApexCharts(
                document.querySelector("#total-revenue-chart"),
                options1
            );
        chart1.render();
        var options = {
                fill: {
                    colors: ["#34c38f"]
                },
                series: [70],
                chart: {
                    type: "radialBar",
                    width: 45,
                    height: 45,
                    sparkline: {
                        enabled: !0
                    },
                },
                dataLabels: {
                    enabled: !1
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 0,
                            size: "60%"
                        },
                        track: {
                            margin: 0
                        },
                        dataLabels: {
                            show: !1
                        },
                    },
                },
            },
            chart = new ApexCharts(document.querySelector("#orders-chart"), options);
        chart.render();
        options = {
            fill: {
                colors: ["#5b73e8"]
            },
            series: [55],
            chart: {
                type: "radialBar",
                width: 45,
                height: 45,
                sparkline: {
                    enabled: !0
                },
            },
            dataLabels: {
                enabled: !1
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "60%"
                    },
                    track: {
                        margin: 0
                    },
                    dataLabels: {
                        show: !1
                    },
                },
            },
        };
        (chart = new ApexCharts(
            document.querySelector("#customers-chart"),
            options
        )).render();
        var options2 = {
                series: [{
                    data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
                }],
                fill: {
                    colors: ["#f1b44c"]
                },
                chart: {
                    type: "bar",
                    width: 70,
                    height: 40,
                    sparkline: {
                        enabled: !0
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%"
                    }
                },
                labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                xaxis: {
                    crosshairs: {
                        width: 1
                    }
                },
                tooltip: {
                    fixed: {
                        enabled: !1
                    },
                    x: {
                        show: !1
                    },
                    y: {
                        title: {
                            formatter: function(e) {
                                return "";
                            },
                        },
                    },
                    marker: {
                        show: !1
                    },
                },
            },
            chart2 = new ApexCharts(document.querySelector("#growth-chart"), options2);
        chart2.render();

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formatted = ribuan.join('.').split('').reverse().join('');
            return formatted;
        }
        options = {
            chart: {
                height: 343,
                type: "line",
                stacked: !1,
                toolbar: {
                    show: !1
                }
            },
            stroke: {
                width: [2],
                curve: "smooth"
            },
            plotOptions: {
                bar: {
                    columnWidth: "30%"
                }
            },
            colors: ["#5b73e8"],
            series: [{
                name: "Penjualan",
                type: "area",
                data: [
                    @foreach ($chart as $key => $value)
                        {{ $value }},
                    @endforeach
                ],
            }],
            fill: {
                opacity: [0.85],
                gradient: {
                    inverseColors: !1,
                    shade: "light",
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100],
                },
            },
            labels: [
                @foreach ($chart as $key => $value)
                    "{{ $key }}",
                @endforeach
            ],
            markers: {
                size: 0
            },
            yaxis: {
                title: {
                    text: "Rupiah"
                }
            },
            tooltip: {
                shared: !0,
                intersect: !1,
                y: {
                    formatter: function(e) {
                        if (e !== undefined) {
                            return "Rp " + formatRupiah(e.toFixed(0));
                        }
                        return e;
                    },
                },

            },
            grid: {
                borderColor: "#f1f1f1"
            },
        };
        (chart = new ApexCharts(
            document.querySelector("#sales-analytics-chart"),
            options
        )).render();
    </script>
@endsection
