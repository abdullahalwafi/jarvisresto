@extends('admin')
@section('content')
    <script>
        const confirmAction = () => {
            const response = confirm("Are you sure you want to do that?");

            if (response) {
                alert("Ok was pressed");
            } else {
                alert("Cancel was pressed");
            }
        }
    </script>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{ $title }} Table</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a data-bs-toggle="modal" data-bs-target="#createTransaksi"
                                class="text-white btn btn-primary btn-sm">+ add</a></li>
                    </ol>
                </div>

            </div>

        </div>

    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data table</h4>

                    @if (session()->has('success'))
                        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                            {{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap"
                            style=" border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pesanan</th>
                                    <th>Total Bayar</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Kembalian</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->pesanan->kode_pesanan }}</td>
                                        <td>{{ number_format($item->total_bayar, 0, ',', '.') }} </td>
                                        <td>{{ number_format($item->jumlah_bayar, 0, ',', '.') }} </td>
                                        <td>{{ number_format($item->kembalian, 0, ',', '.') }} </td>
                                        <td>{{ $item->metode_pembayaran }}</td>
                                        <td class="table-{{ $item->status == 'success' ? 'success' : 'warning' }}">
                                            {{ $item->status }}</td>
                                        <td class="d-flex">
                                            @if ($item->status != 'success')
                                                <a href="" type="button" class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editTransaksi{{ $item->id }}">Edit</a>

                                                <div class="modal fade" id="editTransaksi{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Status
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="transaksi/{{ $item->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="form-group">
                                                                        <label for="status">Status</label>
                                                                        <select name="status" class="form-control">
                                                                            <option value="success"
                                                                                {{ $item->status == 'success' ? 'selected' : '' }}>
                                                                                Success
                                                                            </option>
                                                                            <option value="pending"
                                                                                {{ $item->status == 'pending' ? 'selected' : '' }}>
                                                                                Pending
                                                                            </option>
                                                                            <option value="cancel"
                                                                                {{ $item->status == 'cancel' ? 'selected' : '' }}>
                                                                                Cancel
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <input type="submit" class="btn btn-warning mt-3"
                                                                        value="Update">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

    <div class="modal fade" id="createTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Transaksi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/transaksi" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="pesanan_id">Pesanan</label>
                            <select name="pesanan_id" id="pesanan_id" class="form-control" required>
                                <option value="">~ Silahkan Pilih ~</option>
                                @foreach ($pesanan as $item)
                                    <option value="{{ $item->id }}" data-harga="{{ $item->total_harga }}">
                                        {{ 'kode : ' . $item->kode_pesanan . ' | meja : ' . $item->nomeja . " | pemesan : $item->nama_pemesan" }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="total_bayar">Total bayar</label>
                            <input type="number" name="total_bayar" on id="total_bayar" value="0" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah_bayar">Jumlah bayar</label>
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar" value="0" class="form-control"
                                onkeyup="Bayar()" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kembalian">Kembalian</label>
                            <input type="number" name="kembalian" id="kembalian" value="0" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="success">
                                    Success
                                </option>
                                <option value="pending">
                                    Pending
                                </option>
                                <option value="cancel">
                                    Cancel
                                </option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary mt-3" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pesananSelect = document.getElementById("pesanan_id");
            var totalBayarInput = document.getElementById("total_bayar");

            pesananSelect.addEventListener("change", function() {
                var selectedOption = pesananSelect.options[pesananSelect.selectedIndex];
                var harga = selectedOption.getAttribute("data-harga");

                // Mengisi nilai total_bayar dengan harga yang dipilih
                totalBayarInput.value = harga;
            });
        });
        // bayar
        function Bayar() {
            var total_bayar = document.getElementById("total_bayar").value;
            var jumlah_bayar = document.getElementById("jumlah_bayar").value;

            var hasil = jumlah_bayar - total_bayar;
            document.getElementById("kembalian").value = hasil;
        }
    </script>
@endsection
