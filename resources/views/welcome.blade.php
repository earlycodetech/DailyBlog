@extends('layouts.app')
@section('content')
    {{-- Latest Post Starts --}}
    <section>
        <div id="latestPosts" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#latestPosts" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#latestPosts" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#latestPosts" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('logo.png') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('logo.png') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('logo.png') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#latestPosts" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#latestPosts" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    {{-- Latest Posts Ends --}}


    {{-- Posts Start --}}
    <section class="my-5 container">
        <h3 class="fw-semibold mb-4">Popular Posts</h3>

        <div class="row">
            @for ($i = 0; $i < 9; $i++)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card border-0 shadow post-card">
                        <div class="box border-bottom">
                            <img src="{{ asset('boris.png') }}" class="card-img-top" alt="">
                        </div>
                        <div class="card-body">
                            <h5 class="fw-semibold">This is the title</h5>
                            <p>
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Inventore, quibusdam?
                            </p>
                            <a href="" class="btn btn-primary rounded-pill">
                                Read More <i class="fa-solid fa-book-open-reader"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>
    {{-- Posts End --}}
@endsection
