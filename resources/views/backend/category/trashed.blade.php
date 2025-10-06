@extends('layouts.backend')

@section('category', 'active')

@section('page_title', 'Category Recycle Bin')

@section('content')
    <div class="page-header">
        <div>
            <h3>Category Recycle Bin</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">Categories</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Recycle Bin</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="card text-center border border-primary p-3 mb-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary" href="{{ route('admin.categories.index') }}">Back to Categories</a>
            </li>
        </ul>
    </div>

    <div class="card border border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Trashed Category Items</h5>
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
                                        <li><strong>Deleted At:</strong> {{ $item->deleted_at->diffForHumans() }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('admin.categories.restore', $item->id) }}" method="POST"
                                            class="mr-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                        <form action="{{ route('admin.categories.forceDelete', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to permanently delete this category? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete
                                                Permanently</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">No trashed categories found.</td>
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
            <h5 class="mb-0">Total Trashed Categories: {{ $categories->total() }}</h5>
        </div>
    </div>
@endsection