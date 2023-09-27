<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/favicon.png" rel="icon" />
    <meta name="author" content="Al Wafi Sysdev">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/logo/1763145506_download.jpg">
    <title>Laporan Transaksi - {{ $bulantahun }}</title>

    <!-- Web Fonts ======================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
        type='text/css'>

    <!-- Stylesheet ======================= -->
    <link rel="stylesheet" type="text/css" href="/assets/lpr/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/lpr/all.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/lpr/stylesheet.css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Container -->
    <div class="container-fluid invoice-container">
        <!-- Header -->
        <header>
            <div class="row align-items-center">
                <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">
                    <img id="logo" style="width: 70px;" src="/assets/images/logo-bk.png" title="Jarvis Resto"
                        alt="Jarvis Resto" />
                </div>
                <div class="col-sm-5 text-center text-sm-end">
                    <h5 class="text-4 mb-0">Jarvis Resto</h5>
                    <font size="2"><br />Jakarta Indonesia <br /> Tlp: +62 855-888-3118</font>

                </div>
            </div>
            <hr>
        </header>
        <!-- Main Content -->
        <main>
            <div class="row">
                <div class="col-sm-6"><strong>Laporan transaksi {{ $bulantahun }}</div>

            </div>
            <hr>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tr class="card-header" style="background-color: #F7F7F7;">
                                <td class="col-1 text-center"><strong>Kode Pesanan</strong></td>
                                <td class="col-2 text-center"><strong>Total Bayar</strong></td>
                                <td class="col-2 text-center"><strong>Jumlah Bayar</strong></td>
                                <td class="col-2 text-center"><strong>Kembalia</strong></td>
                                <td class="col-1 text-center"><strong>Status</strong></td>
                            </tr>
                            <?php
                            $total = 0;
                            ?>

                            @foreach ($transaksi as $item)
                                <tr style="text-align: center;" class="">
                                    <td class="col-1">{{ $item->pesanan->kode_pesanan }}</td>
                                    <td class="col-2">
                                        <?= number_format($item->total_bayar, 0, ',', '.') ?>
                                    </td>
                                    <td class="col-2">
                                        <?= number_format($item->jumlah_bayar, 0, ',', '.') ?>
                                    </td>
                                    <td class="col-2">
                                        <?= number_format($item->kembalian, 0, ',', '.') ?>
                                    </td>
                                    <td class="col-1">{{ $item->status }}</td>
                                </tr>
                                <?php $total += $item->total_bayar; ?>
                            @endforeach
                            <tr>
                                <td class="col-1 text-end"><strong>Total :</strong></td>
                                <td class="col-1 text-center"><strong><?= number_format($total, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer class="text-center mt-4">
            <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()"
                    class="btn btn-light border text-black-50 shadow-none"><i class="ft-printer"></i> Print</a><a
                    href="/dashboard" class="btn btn-light border text-black-50 shadow-none"><i
                        class="ft-skip-back"></i>dashboard</a></div>
        </footer>
    </div>
    <script src="/assets/js/pages/fontawesome.init.js"></script>
</body>

</html>
