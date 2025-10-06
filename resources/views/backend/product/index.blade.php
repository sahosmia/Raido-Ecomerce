@extends('layouts.backend')

@section('product', 'active')

@section('page_title', 'Product')

@section('content')
    <div class="page-header">
        <div>
            <h3>Product Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product Page</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="card text-center border border-primary p-3 mb-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary mr-2" href="{{ route('admin.products.create') }}">Add New</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-dark" href="{{ route('admin.products.trashed') }}">Recycle Bin</a>
            </li>
        </ul>
    </div>

    <div class="card text-center border border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Product Items</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Product Photos</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $key => $item)
                            <tr>
                                <th>{{ $products->firstItem() + $key }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <figure class="avatar">
                                        <img src="{{ asset('upload/product/' . $item->img) }}" alt="Product Image">
                                    </figure>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.photos.index', $item->id) }}">
                                        <div class="avatar-group">
                                            @foreach ($item->photos->take(3) as $product_photo)
                                                <figure class="avatar">
                                                    <img src="{{ asset('upload/product_photo/' . $product_photo->img) }}"
                                                        class="rounded-circle" alt="Product Photo">
                                                </figure>
                                            @endforeach
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <ul class="list-unstyled text-left">
                                        @if ($item->discount)
                                            <li><strong>Discount:</strong> {{ $item->discount }}%</li>
                                        @endif
                                        <li><strong>Subcategory:</strong> {{ $item->subcategory_info->name ?? 'N/A' }}</li>
                                        <li><strong>Category:</strong> {{ $item->category_info->name ?? 'N/A' }}</li>
                                        <li><strong>Quantity:</strong> {{ $item->quantity }}</li>
                                        @if ($item->notification_quantity)
                                            <li><strong>Notification Quantity:</strong> {{ $item->notification_quantity }}
                                            </li>
                                        @endif
                                        <li><strong>Added By:</strong> {{ $item->user->name ?? 'N/A' }}</li>
                                        <li><strong>Created At:</strong> {{ $item->created_at->diffForHumans() }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('admin.products.show', $item->id) }}"
                                            class="btn btn-primary btn-sm mr-2">View</a>
                                        <a href="{{ route('admin.products.edit', $item->id) }}"
                                            class="btn btn-info btn-sm mr-2">Edit</a>
                                        <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-danger">No data to display.</td>
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
            <h5 class="mb-0">Total Products: {{ $products->total() }}</h5>
        </div>
    </div>
@endsection