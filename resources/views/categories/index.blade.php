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
                                <tr>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem, ipsum.</td>
                                    <td class="d-flex gap-3">
                                        <a href="" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash-alt"></i>
                                            </button>
                                        </form>
                                       
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection