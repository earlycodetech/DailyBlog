@extends('layouts.app')
@section('content')
    <section>
        <div class="container my-5">
            <div class="card border-0 shadow mx-auto bg-white" style="max-width: 900px;">
                <div class="card-header bg-white">
                    <h2>Edit Post</h2>
                </div>

                <form class="card-body row" method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
                    @csrf @method('PATCH')

                    <div class="text-end my-4">
                        <img src="{{ asset($post->cover_image) }}" width="150" alt="">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" value="{{ $post->title }}" id="title" class="form-control bg-white">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="cover" class="form-label">Cover Image</label>
                        <input type="file" id="cover" name="cover_image" accept="image/*" class="form-control bg-white">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-select bg-white" required> 
                            <option value="">__Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? "selected" : ""}}>
                                    {{ $cat->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="abstract" class="form-label">Abstract</label>
                       <textarea name="abstract" id="abstract"  rows="3" class="form-control bg-white">{{ $post->abstract }}</textarea>
                    </div>

                    <div class="col-12 my-3">
                        <textarea name="content" id="ck-edit" class="form-control bg-white" rows="10">{{ $post->content }}</textarea>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection