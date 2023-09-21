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
                <h4 class="mb-0">{{ $title }} Page</h4>

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
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tables as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->status }}</td>
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
    @foreach ($tables as $item)
        <div class="modal fade" id="deleteCategories{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detele Table {{ $item->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin Delete Data ini? {{ $item->name }}, data Akan Dihapus Permanen
                    </div>
                    <div class="modal-footer">
                        <form action="/table/{{ $item->id }}" method="POST">
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
    @foreach ($tables as $item)
        <div class="modal fade" id="editCategories{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Table {{ $item->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="table/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Table Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="title" value="{{ old('name', $item->name) }}">
                                @error('name')
                                    <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="title">Status</label>


                                <select class="form-select" aria-label="Default select example" name="status">
                                    @foreach (App\Enums\TableStatus::cases() as $item)
                                        <option value="{{ $item->value }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <input type="submit" class="btn btn-warning mt-3" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <!--Add-->
    <div class="modal fade" id="createCategories" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="table" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Table Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="title" value="{{ old('name') }}">
                            @error('nama')
                                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="title">Status</label>


                            <select class="form-select" aria-label="Default select example" name="status">
                                @foreach (App\Enums\TableStatus::cases() as $item)
                                    <option value="{{ $item->value }}">{{ $item->value }}</option>
                                @endforeach
                            </select>

                        </div>
                        <input type="submit" class="btn btn-success mt-3" value="Add">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
