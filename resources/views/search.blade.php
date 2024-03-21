@extends('layouts.app')
@section('content')
    {{-- Posts Start --}}


    <section class="my-5 container">
        <h3 class="fw-semibold mb-4"> Search Result(s) For: "{{ $keyword }}"</h3>


        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card border-0 shadow h-100 post-card">
                        <div class="box border-bottom" style="height: 15rem;">
                            <img src="{{ asset($post->cover_image) }}" class="card-img-top h-100" alt="{{ $post->title }}">
                        </div>
                        <div class="card-body d-flex flex-column gap-2">
                            <h5 class="fw-semibold">{{ $post->title }}</h5>
                            <p class="text-truncate mt-auto">
                                {{ $post->abstract }}
                            </p>
                            <a href="{{ route('read.post', ['slug' => $post->slug]) }}"
                                class="btn btn-primary rounded-pill mt-auto d-block mb-3">
                                Read More <i class="fa-solid fa-book-open-reader"></i>
                            </a>
                        </div>
                    </div>
                </div>

            @empty
                <p class="h2 text-center p-5">
                    Oops No Result Could be found
                </p>
            @endforelse
        </div>


        <div class="p-5">
            {!! $posts->links('pagination::bootstrap-5') !!}
        </div>
    </section>
    {{-- Posts End --}}
@endsection
