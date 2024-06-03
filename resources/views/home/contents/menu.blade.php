@extends('index')

@section('content')
    @include('home.partials.navpart')


    <!-- Team Start -->
    <div class="container-xxl pt-5 pb-3">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Menu</h5>
                <h1 class="mb-3">Our Menu</h1>
                @if (session()->has('added'))
                    <div class="alert alert-success text-center fade show" role="alert">
                        {{ session('added') }}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row g-4 mb-3">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <form action="/search" method="get">
                            @csrf
                            <div class="d-flex my-2">
                                <div class="d-flex col-sm-6 px-2">
                                    <select name="category" class="form-select">
                                        @foreach ($cate as $category)
                                            <option value="{{ $category->id }}"
                                                {{ collect(request()->category)->contains($category->id) ? 'selected' : '' }}>
                                                {{ $category->nama }}
                                            </option>
                                        @endforeach
                                        <option value="" selected="">Category</option>

                                    </select>
                                    <button type="submit" class="btn btn-secondary mx-1">Filter</button>
                                </div>
                                <div class="d-flex col-sm-6 px-2">
                                    <input name="name" type="text" class="form-control" placeholder="Search Menu"
                                        value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}">
                                    <button type="submit" class="btn btn-secondary mx-1 ">Search</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <div class="rounded overflow-hidden mb-2">
                                <img style="height: 200px" class="img-fluid" src="\img\{{ $product->gambar }}" alt="">
                            </div>
                            <h5 class="mb-0">{{ $product->nama }}</h5>
                            <small>@currency($product->harga)</small>
                            <div class="d-flex justify-content-center mt-3">
                                <a class="btn btn-square btn-primary mx-1" href=""data-bs-toggle="modal"
                                    data-bs-target="#detailMenu{{ $product->id }}"><i class="fa fa-info"></i></a>
                                <a class="btn btn-square btn-primary mx-1" href="/cart/cart/{{ $product->id }}"><i
                                        class="fa fa-cart-plus"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <!-- Team End -->

    <!-- View Detail Menu-->
    @foreach ($products as $product)
        <div class="modal fade" id="detailMenu{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <section style="background-color: #eee;">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="card text-black">
                                        <img src="\img\{{ $product->gambar }}" class="card-img-top" style="height:200px"  alt="Menu" />
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h5 class="card-title">{{ $product->nama }}</h5>
                                                <p class="">Description :</p>
                                                <p class="text-muted mb-4">{{ $product->description }}</p>
                                            </div>
                                            <hr>
                                            <div>
                                                <div class="d-flex justify-content-center">
                                                    <span>Harga </span><span> : @currency($product->harga)</span>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <span>Status </span><span> :
                                                        @if ($product->is_ready == 1)
                                                            Ready
                                                        @else
                                                            Kosong
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <span>Category </span><span> : {{ $product->categories->nama }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center total font-weight-bold mt-4">
                                                <a href="/menu" class="btn btn-primary py-2 px-4">Add to Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
