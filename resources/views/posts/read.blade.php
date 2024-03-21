@extends('layouts.app')
@section('content')
    <section class="my-5">
        <article class="container pb-5">
            <div class="card bg-white mx-auto shadow-sm" style="max-width: 900px;">
                <div class="card-body">
                    <header class="text-center">
                        <h1 class="fw-bold mb-3">
                            {{ $post->title }}
                        </h1>

                        <h6 class="mb-3 text-secondary fw-semibold">
                            <i class="fa-solid fa-calendar-day"></i>
                            {{ $post->created_at->format('jS M. Y') }}
                        </h6>

                        <p class="fst-italic text-secondary small lh-lg px-md-5">
                            {{ $post->abstract }}
                        </p>

                        <img src="{{ asset($post->cover_image) }}" class="w-100 ratio-16x9 mb-3 object-fit-cover"
                            style="height: 250px; min-height: 400px;" alt="{{ $post->title }}">

                        <h6 class="mb-3 text-secondary fw-semibold">
                            <i class="fa-solid fa-newspaper"></i>
                            {{ $post->category->title }}
                        </h6>

                    </header>


                    <div class="my-3 px-md-5 ck-content">
                        {!! $post->content !!}
                    </div>
                </div>
                <div class="card-footer bg-white" id="comments">
                    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-2">
                        <p class="h5 fw-bold m-0">
                            Comments
                        </p>

                        @include('partials.new-comment')
                    </div>

                    <div class="">
                        <ul class="list-group list-group-flush">
                            @php
                                $comments = $post->comments()->latest()->get();
                            @endphp
                            @forelse ($comments as $comment)
                                <li class="list-group-item bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            @if ($comment->user)
                                                <p class="fw-bold h5 m-0"> {{ $comment->user->name }} </p>
                                                <p class="m-0 small text-sencondary fst-italic">{{ $comment->user->email }}
                                                </p>
                                            @else
                                                <p class="fw-bold h5 m-0"> DELETED ACCOUNT </p>
                                            @endif
                                        </div>

                                        <p class="small fw-semibold text-secondary">
                                            {{ $comment->created_at->diffForHumans() }} </p>
                                    </div>

                                    <div>
                                        <p>
                                            {{ $comment->comment }}
                                        </p>
                                    </div>
                                </li>
                            @empty
                                <p class="h4 fw-bold text-center">
                                    Be the first to comment on this post...
                                </p>
                            @endforelse
                        </ul>
                    </div>

                </div>



                {{-- LIKE STARTS --}}
                <form action="{{ route('new.like', ['slug' => $post->slug]) }}" method="POST" id="likes">
                    @csrf
                    
                    <button class="btn {{ $hasLiked ? 'btn-primary' : 'btn-secondary' }}">
                        <i class="fa-solid fa-thumbs-up fs-1"></i>
                    </button>


                    <p class="text-secondary">
                        @php
                            $total_likes = $post->likes->count();
                            if ($total_likes < 1000) {
                                $likes = $total_likes;
                            } else {
                                $likes = strval($total_likes);
                                $likes = Str::substr($likes, 0, 1) . 'k+';
                            }
                        @endphp

                        {!! $likes !!}
                        {{ $post->likes->count() <= 1 ? 'like' : 'likes' }}
                    </p>
                </form>
                {{-- LIKE ENDS --}}
            </div>
        </article>
    </section>
@endsection
