@extends('layouts.app')
@section('content')
    {{-- Latest Post Starts --}}
    <section>
        <div id="latestPosts" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @forelse ($latest as $post)
                    <button type="button" 
                        data-bs-target="#latestPosts" 
                        data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->index == 0 ? 'active' : '' }}" 
                        aria-current="true" 
                        aria-label="{{ $post->title }}"
                    ></button>
                @empty
                    <button type="button" data-bs-target="#latestPosts" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                @endforelse

            </div>
            <div class="carousel-inner">
                @forelse ($latest as $post)
                    <a href="{{ route('read.post',['slug' => $post->slug]) }}">
                        <div class="carousel-item  {{ $loop->index == 0 ? 'active' : '' }} ">
                            <img src="{{ asset($post->cover_image) }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>
                                    {{ $post->title }}
                                </h5>
                                <p>
                                    {{ $post->abstract }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="carousel-item active">
                        <img src="{{ asset('logo.png') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5> Welcome to Daily Blog </h5>
                            <p>
                                Where we deliver the news promptly.
                            </p>
                        </div>
                    </div>
                @endforelse

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

    @foreach ($categories as $cat)
        <section class="my-5 container">
            <h3 class="fw-semibold mb-4"> {{ $cat->title }} </h3>

            @php
                $posts = $cat->posts()->latest()->take(6)->get();
            @endphp
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card border-0 shadow h-100 post-card">
                            <div class="box border-bottom" style="height: 15rem;">
                                <img src="{{ asset($post->cover_image) }}" class="card-img-top h-100"
                                    alt="{{ $post->title }}">
                            </div>
                            <div class="card-body d-flex flex-column gap-2">
                                <h5 class="fw-semibold">{{ $post->title }}</h5>
                                <p class="text-truncate mt-auto">
                                    {{ $post->abstract }}
                                </p>
                                <a href="{{ route('read.post', ['slug' => $post->slug]) }}" class="btn btn-primary rounded-pill mt-auto d-block mb-3">
                                    Read More <i class="fa-solid fa-book-open-reader"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach
    {{-- Posts End --}}
@endsection
