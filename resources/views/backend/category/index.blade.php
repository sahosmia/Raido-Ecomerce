@extends('layouts.backend')

@section('category', 'active')

@section('page_title', 'Categories')

@section('content')
    <div class="page-header">
        <div>
            <h3>Category Management</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="card text-center border border-primary p-3 mb-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary mr-2" href="{{ route('admin.categories.create') }}">Add New Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-dark" href="{{ route('admin.categories.trashed') }}">Recycle Bin</a>
            </li>
        </ul>
    </div>

    <div class="card border border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Category List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $key => $item)
                            <tr>
                                <th>{{ $categories->firstItem() + $key }}</th>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <figure class="avatar">
                                        <img src="{{ asset('upload/category/' . $item->img) }}" alt="Category Image">
                                    </figure>
                                </td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        <li><strong>Added By:</strong> {{ $item->user->name ?? 'N/A' }}</li>
                                        <li><strong>Created At:</strong> {{ $item->created_at->diffForHumans() }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('admin.categories.edit', $item) }}"
                                            class="btn btn-info btn-sm mr-2">Edit</a>
                                        <form action="{{ route('admin.categories.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
        <div class="card-footer bg-primary text-white">
            <h5 class="mb-0">Total Categories: {{ $categories->total() }}</h5>
        </div>
    </div>
@endsection