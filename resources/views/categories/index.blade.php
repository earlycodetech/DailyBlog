@extends('layouts.app')
@section('content')
    <section>
        <div class="container my-5">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="text-end">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary"> Create New Category </a>
                    </div>

                    <div class="my-3 table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="row">Title</th>
                                    <th scope="row">Date Created</th>
                                    <th scope="row">Last Updated</th>
                                    <th>
                                        <i class="fa-solid fa-ellipsis-h"></i>
                                    </th>
                                </tr>
                            </thead>


                            <tbody>
                                @forelse ($categories as $cat)
                                    <tr>
                                        <td> {{ $cat->title }} </td>
                                        <td> {{ $cat->created_at->format('jS M. Y h:i a') }} </td>
                                        <td> {{ $cat->updated_at->diffForHumans() }} </td>
                                        <td class="d-flex gap-3">
                                            <a href="{{ route('categories.show', ['category' => $cat->id]) }}" class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('categories.edit', ['category' => $cat->slug]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', ['category' => $cat->id]) }}"
                                                method="post" onsubmit="return confirm('Are you sure?')"
                                                >
                                                @csrf 
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash-alt"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center"> No Category Created Yet </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="p-2">
                            {!! $categories->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
