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
                        <li class="breadcrumb-item active"><a data-bs-toggle="modal" data-bs-target="#createCategories"
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
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->nama }}</td>
                                    <td class="text-center"><a href="" type="button" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#picture{{ $item->id }}">picture</a>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        @can('admin')
                                            <a href="" type="button" class="btn btn-warning btn-sm mx-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editCategories{{ $item->id }}">Edit</a>
                                            <a href="" type="button" class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteCategories{{ $item->id }}">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

    <!-- Modal Delete-->
    @foreach ($categories as $item)
        <div class="modal fade" id="deleteCategories{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detele Categories {{ $item->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin Delete Data ini? {{ $item->nama }}, data Akan Dihapus Permanen
                    </div>
                    <div class="modal-footer">
                        <form action="categories/{{ $item->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Category Edit-->
    @foreach ($categories as $item)
        <div class="modal fade" id="editCategories{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Categories {{ $item->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="categories/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Nama Categories</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="title" value="{{ old('nama', $item->nama) }}">
                                @error('nama')
                                    <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="categoryGambar" class="form-label">Gambar</label>
                                <input class="form-control @error('gambar') is-invalid @enderror" type="file"
                                    id="categoryGambar" name="gambar">
                                @error('gambar')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-warning mt-3" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Category Add-->
    <div class="modal fade" id="createCategories" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="categories" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Nama Categories</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="title" value="{{ old('nama') }}">
                            @error('nama')
                                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="categoryGambar" class="form-label">Gambar</label>
                            <input class="form-control @error('gambar') is-invalid @enderror" type="file"
                                id="categoryGambar" name="gambar">
                            @error('gambar')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-success mt-3" value="Add">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Category picture-->
    @foreach ($categories as $item)
        <div class="modal fade" id="picture{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Image Category {{ $item->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="\public\img\categories\{{ $item->gambar }}" alt="" width="30%"
                            height="30%">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
