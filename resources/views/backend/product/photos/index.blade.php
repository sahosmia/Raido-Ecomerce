@extends('layouts.backend')

@section('product', 'active')

@section('page_title', 'Product Photos')

@section('content')
    <div class="page-header">
        <div>
            <h3>Photos for "{{ $product->name }}"</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product Photos</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="card text-center border border-primary p-3 mb-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary"
                    href="{{ route('admin.products.photos.create', $product->id) }}">Add New Photos</a>
            </li>
        </ul>
    </div>

    <div class="card border border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Product Photo Gallery</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product_photos as $key => $item)
                            <tr>
                                <th>{{ $product_photos->firstItem() + $key }}</th>
                                <td>
                                    <figure class="avatar avatar-lg">
                                        <img src="{{ asset('upload/product_photo/' . $item->img) }}"
                                            alt="Product Photo">
                                    </figure>
                                </td>
                                <td class="text-left">
                                    <ul class="list-unstyled">
                                        <li><strong>Added By:</strong> {{ $item->user->name ?? 'N/A' }}</li>
                                        <li><strong>Created At:</strong> {{ $item->created_at->diffForHumans() }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <form action="{{ route('admin.products.photos.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ti-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-danger">No photos found for this product.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $product_photos->links() }}
            </div>
        </div>
        <div class="card-footer bg-primary text-white">
            <h5 class="mb-0">Total Photos: {{ $product_photos->total() }}</h5>
        </div>
    </div>
@endsection