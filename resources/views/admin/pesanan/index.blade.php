@extends('admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{ $title }} Table</h4>

            </div>

        </div>

    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data table</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap"
                            style=" border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pesanan</th>
                                    <th>Pemesan</th>
                                    <th>No Hp</th>
                                    <th>No Meja</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_pesanan }}</td>
                                        <td>{{ $item->nama_pemesan }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->table->name }}</td>
                                        <td>{{ number_format($item->total_harga, 0, ',', '.') }} </td>
                                        <td class="table-{{ $item->status == 'success' ? 'success' : 'warning' }}">
                                            {{ $item->status }}</td>
                                        <td class="d-flex">

                                            <a href="" type="button" class="btn btn-info btn-sm mx-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#pesanan_details{{ $item->id }}">Detail</a>

                                            <div class="modal fade" id="pesanan_details{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan
                                                                {{ $item->kode_pesanan }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Produk</th>
                                                                        <th>Qty</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($item->pesanan_details as $detail)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ $detail->products->nama }}</td>
                                                                            <td>{{ $detail->qty }}</td>
                                                                            <td>{{ number_format($detail->total_harga, 0, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="3">Total Harga</td>
                                                                        <td>{{ number_format($item->total_harga, 0, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->status != 'success')
                                                <a href="" type="button" class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPesanan{{ $item->id }}">Edit</a>

                                                <div class="modal fade" id="editPesanan{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Status
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="pesanan/{{ $item->id }}" method="POST">
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
@endsection
