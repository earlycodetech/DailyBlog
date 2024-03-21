@extends('layouts.app')
@section('content')
    <section>
        <div class="container my-5">
            <div class="card border-0 shadow mx-auto bg-white" style="max-width: 900px;">
                <div class="card-header bg-white">
                    <h2>Create New Post</h2>
                </div>

                <form class="card-body row" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control bg-white">
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
                                <option value="{{ $cat->id }}">
                                    {{ $cat->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="abstract" class="form-label">Abstract</label>
                       <textarea name="abstract" id="abstract"  rows="3" class="form-control bg-white"></textarea>
                    </div>

                    <div class="col-12 my-3">
                        <textarea name="content" id="ck-edit" class="form-control bg-white" rows="10"></textarea>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary">
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection