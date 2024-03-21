@extends('layouts.app')
@section('content')
    <section>
        <div class="container my-5">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="text-end">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary"> Create New Post </a>
                    </div>

                    <div class="my-3 table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="row">Cover</th>
                                    <th scope="row">Title</th>
                                    <th scope="row">Date Created</th>
                                    <th scope="row">Last Updated</th>
                                    <th>
                                        <i class="fa-solid fa-ellipsis-h"></i>
                                    </th>
                                </tr>
                            </thead>


                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($post->cover_image) }}" style="width: 100px; height: 80px;"
                                                class="object-fit-contain rounded-lg ratio-16x9" alt="">
                                        </td>

                                        <td>
                                            {{ $post->title }}
                                        </td>
                                        <td>
                                            {{ $post->created_at->format('jS M. Y h:i a') }}
                                        </td>
                                        <td>
                                            {{ $post->updated_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>

                                                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                    onsubmit="return confirm('Are you sure?')" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center"> No Post(s) Created Yet </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="p-2">
                            {!! $posts->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
