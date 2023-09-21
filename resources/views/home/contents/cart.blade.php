@extends('index')

@section('content')
    @include('home.partials.navpart')
    <section class="h-100" style="background-color: #eee;">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">
                    @if (session()->has('deleted'))
                        <div class="alert alert-success text-center fade show" role="alert">
                            {{ session('deleted') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                        <div>
                            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                    class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                        </div>
                    </div>
                    @if (session('cart'))
                        @php
                            $total = 0;
                        @endphp
                        @foreach (session('cart') as $id => $product)
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="\img\{{ $product['image'] }}" class="img-fluid rounded-3"
                                                alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">{{ $product['name'] }}</p>
                                            <p> <span class="text-muted">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="quantity_{{ $id }}" min="0" name="quantity"
                                                value="{{ $product['quantity'] }}" type="number"
                                                class="form-control form-control-sm" />

                                            <button class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0"> Rp.<?= number_format($product['total'], 0, ',', '.') ?></h5>
                                        </div>
                                        <div class="actions col-md-1 col-lg-1 col-xl-1 text-end">
                                            <button class="btn text-primary btn-sm tambah-quantity"
                                                data-product-id="{{ $id }}"><i
                                                    class="fas fa-save fa-lg"></i></button>
                                            <button class="btn text-danger btn-sm delete-cart"
                                                data-product-id="{{ $id }}"><i
                                                    class="fas fa-trash fa-lg"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $total += $product['total'];
                            @endphp
                        @endforeach

                        <form action="/checkout" method="post">
                            @csrf

                            <div class="card mb-4">
                                <div class="card-header">Metode pembayaran</div>
                                <div class="card-body row">
                                    <div class="col-2">
                                        <label>
                                            <input type="radio" name="metode" value="cash" data-admin-fee="0" checked
                                                required>
                                            <img style="width: 70px"
                                                src="https://t3.ftcdn.net/jpg/04/49/22/98/360_F_449229860_uczw7ZS0sw6Ou31yhifld9s0KHkdULcR.jpg"
                                                alt="cash">
                                            <small> admin : 0

                                            </small>
                                        </label>
                                    </div>
                                    <!-- -->
                                    @foreach ($metode as $item)
                                        @if ($item->active)
                                            @php
                                                $admin = $item->total_fee->flat + ($item->total_fee->percent / 100) * $total;
                                            @endphp
                                            <div class="col-2">
                                                <label>
                                                    <input type="radio" name="metode" value="{{ $item->code }}"
                                                        data-admin-fee="{{ $admin }}" required>
                                                    <img style="width: 70px" src="{{ $item->icon_url }}"
                                                        alt="{{ $item->name }}">
                                                    <small>admin : {{ number_format($admin, 0, ',', '.') }}</small>
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body p-4 d-flex flex-row">
                                    <div class="form-outline flex-fill">
                                        <h3>Total</h3>
                                    </div>
                                    <div class="">
                                        <h3 class="mb-0 total-price">Rp.<?= number_format($total, 0, ',', '.') ?></h3>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="total_bayar" value="{{ $total }}">

                            <div class="card mb-4">
                                <div class="card-header">Data Pemesan</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="nama_pemesan" class="col-4">Nama</label>
                                            <input type="text" name="nama_pemesan" class="form-control col-8" required>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="no_hp" class="col-4">No Hp</label>
                                            <input type="number" name="no_hp" class="form-control col-8" required>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="nomeja" class="col-4">Pilih Meja</label>
                                            <select name="nomeja" id="nomeja" class="form-select">
                                                @if ($tables->isEmpty())
                                                    <option value="" disabled>Tidak Ada Meja yang Tersedia
                                                    </option>
                                                @else
                                                    <option value="">Select</option>
                                                    @foreach ($tables as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card d-flex">
                                <div class="card-body d-flex  justify-content-center">
                                    <button type="submit" class="btn btn-warning btn-block btn-lg">Proceed to
                                        Pay</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Table -->

    <div class="modal fade" id="tableSelect" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Table Selector</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="/js/script.js"></script>
    @if (session('cart'))
        <script type="text/javascript">
            $(document).ready(function() {
                $('.delete-cart').click(function(e) {
                    e.preventDefault();

                    var productId = $(this).data('product-id');

                    if (confirm("Do you really want to delete?")) {
                        $.ajax({
                            url: '/delete-cart-product/' + productId,
                            method: "DELETE",
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    window.location.reload();
                                } else {
                                    alert('Failed to delete item.');
                                }
                            },
                            error: function(xhr) {
                                alert('Error: ' + xhr.statusText);
                            }
                        });
                    }
                });
            });
            $(document).ready(function() {
                $('.tambah-quantity').click(function(e) {
                    e.preventDefault();

                    var productId = $(this).data('product-id');
                    var newQuantity = $('#quantity_' + productId)
                        .val();

                    $.ajax({
                        url: '/update-cart/' + productId,
                        method: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            quantity: newQuantity
                        },
                        success: function(response) {
                            if (response.success) {
                                window.location.reload();
                            } else {
                                alert('Failed to delete item.');
                            }
                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.statusText);
                        }
                    });
                });
            });
            $(document).ready(function() {
                // Mendaftarkan event listener pada perubahan pemilihan metode pembayaran
                $('input[name="metode"]').change(function() {
                    // Mendapatkan biaya admin yang terkait dengan metode pembayaran yang dipilih
                    var selectedAdminFee = parseFloat($('input[name="metode"]:checked').data('admin-fee')) || 0;

                    // Mendapatkan total harga
                    var total = parseFloat('{{ $total }}');

                    // Menghitung total harga yang baru dengan biaya admin
                    var newTotal = total + selectedAdminFee;

                    // Memperbarui tampilan total dengan harga yang baru
                    $('.total-price').text('Rp.' + newTotal.toLocaleString('id-ID'));
                });
            });
        </script>
    @endif
@endsection
