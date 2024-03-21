@extends('layouts.app')
@section('content')
    <section>
        <div class="container my-5">
            <h1> Edit: {{ $category->title }} </h1>

            <form action="{{ route('categories.update', ['category' =>  $category->id]) }}" method="post" class="card border-0 bg-white shadow">
                @csrf 
                @method('PATCH')

               
                <div class="card-body">
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" value="{{ $category->title }}" class="form-control bg-white @error('title') is-invalid @enderror">

                    @error('title')
                        <p class="small fw-bold text-danger">
                            <i class="fa-solid fa-exclamation-triangle"></i> {{ $message }}
                        </p>
                    @enderror

                    <div class="my-3">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
