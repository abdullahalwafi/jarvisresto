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

                @can('admin')
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><a href="/product/create"
                                    class="text-white btn btn-primary btn-sm">+
                                    add</a></li>
                        </ol>
                    </div>
                @endcan
            </div>
        </div>
    </div>
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
                    @if (session()->has('delete'))
                        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                            {{ session('delete') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table id="datatable-buttons" class="table table-striped table-bordered nowrap"
                        style=" border-collapse: collapse; border-spacing: 0; width: 100%; ">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Is Ready?</th>
                                <th>Category</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->nama }}</td>
                                    <td class="text-center">{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if ($item->is_ready == 1)
                                            Ready
                                        @else
                                            Kosong
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->categories->nama }}</td>

                                    <td class="text-center"><a href="" type="button" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#picture{{ $item->id }}">picture</a>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        @can('admin')
                                            <a href="/product/{{ $item->id }}/edit"><button
                                                    class="btn btn-warning btn-sm mx-2">Edit</button></a>
                                            <a href="" type="button" class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteProduct{{ $item->id }}">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal picture-->
    @foreach ($products as $item)
        <div class="modal fade" id="picture{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Image Product {{ $item->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="\public\img\{{ $item->gambar }}" alt="" width="30%" height="30%">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal picture-->
    @foreach ($products as $item)
        <div class="modal fade" id="deleteProduct{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detele Product {{ $item->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin Delete Data ini? {{ $item->nama }}, data Akan Dihapus Permanen
                    </div>
                    <div class="modal-footer">
                        <form action="product/{{ $item->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
