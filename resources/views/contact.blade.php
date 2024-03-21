@extends('layouts.app')
@section('content')
    <section>
        <div class="container my-5">
            <div class="card mx-auto" style="max-width: 600px;">
                <form action="{{ route('contact.submit') }}" method="POST"  class="card-body">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <textarea name="message" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="text-center mb-3">
                        <button class="btn btn-success">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection