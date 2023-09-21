@extends('index')

@section('content')
    @include('home.partials.navpart')
    <!-- Team Start -->
    <div class="container-xxl pt-5 pb-3">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Category</h5>
                <h1 class="mb-5">Our Category Menu</h1>
            </div>

            <div class="row ">
                @foreach ($categories as $category)
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <div class="rounded overflow-hidden mb-2" style="max-height: 50%;">
                                <img class="img-fluid" src="\public\img\categories\{{ $category->gambar }}" alt="">
                            </div>
                            <h5 class="mt-5">{{ $category->nama }}</h5>
                            <div class="mt-2">
                                <a href="view-category/{{ $category->id }}" class="link-warning">View More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- Team End -->
@endsection
