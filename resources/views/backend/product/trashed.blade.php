@extends('layouts.backend')

@section('product', 'active')

@section('page_title', 'Product Recycle Bin')

@section('content')
    <div class="page-header">
        <div>
            <h3>Product Recycle Bin</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Products</a>
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
                <a class="nav-link btn btn-primary" href="{{ route('admin.products.index') }}">Back to Products</a>
            </li>
        </ul>
    </div>

    <div class="card border border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Trashed Product Items</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $item)
                            <tr>
                                <th>{{ $products->firstItem() + $key }}</th>
                                <td>{{ $item->name }}</td>
                                <td>${{ $item->price }}</td>
                                <td>
                                    <figure class="avatar">
                                        <img src="{{ asset('upload/product/' . $item->img) }}" alt="Product Image">
                                    </figure>
                                </td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        @if ($item->discount)
                                            <li><strong>Discount:</strong> {{ $item->discount }}%</li>
                                        @endif
                                        <li><strong>Category:</strong> {{ $item->category_info->name ?? 'N/A' }}</li>
                                        <li><strong>Subcategory:</strong> {{ $item->subcategory_info->name ?? 'N/A' }}
                                        </li>
                                        <li><strong>Quantity:</strong> {{ $item->quantity }}</li>
                                        @if ($item->notification_quantity)
                                            <li><strong>Alert Quantity:</strong> {{ $item->notification_quantity }}</li>
                                        @endif
                                        <li><strong>Added By:</strong> {{ $item->user->name ?? 'N/A' }}</li>
                                        <li><strong>Deleted At:</strong> {{ $item->deleted_at->diffForHumans() }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('admin.products.restore', $item) }}" method="POST"
                                            class="mr-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                        <form action="{{ route('admin.products.forceDelete', $item) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to permanently delete this product? This action cannot be undone.');">
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
                                <td colspan="6" class="text-center text-danger">No trashed products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
        <div class="card-footer bg-primary text-white">
            <h5 class="mb-0">Total Trashed Products: {{ $products->total() }}</h5>
        </div>
    </div>
@endsection