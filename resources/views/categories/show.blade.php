@extends('layouts.app')
@section('content')
    <section>
        <div class="container my-5">
            <h1> Now Viewing: <strong> {{ $category->title }}</strong></h1>
        </div>
    </section>
@endsection