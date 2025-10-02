@extends('layouts.backend')

{{-- nav active satatus --}}
@section('product')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Product Photos
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>Product Photos for "{{ $product->name }}"</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Product</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product Photos</li>
                </ol>
            </nav>
        </div>
    </div>
 @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="ti-check mr-2"></i> {{ session()->get('success') }}
    </div>
@endif
 @if(session()->has('error'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="ti-close mr-2"></i> {{ session()->get('error') }}
    </div>
@endif

    <div class="card text-center border border-primary p-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary mr-2" href="{{ route('admin.products.photos.create', $product->id) }}">Add New Photos</a>
            </li>
        </ul>
    </div>

    <div class="card text-center border border-primary">
        <div class="card-header bg-primary">
            <h5>Product Photo Items</h5>
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($product_photos as $key => $item)
                        <tr>
                            <th scope="row">{{ $product_photos->firstItem() + $key }}</th>
                            <td>
                                <figure class="avatar">
                                    <img src="{{ asset('upload/product_photo') }}/{{ $item->img }}" alt="avatar">
                                </figure>
                            </td>
                            <td>
                                <ul>
                                    <li>Added By : {{ $item->user->name ?? 'N/A' }}</li>
                                    <li>Created At : {{ $item->created_at->diffForHumans() }}</li>
                                </ul>
                            </td>
                            <td>
                                <form action="{{ route('admin.products.photos.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="ti-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">No Data to Show</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $product_photos->links() }}
        </div>
        <div class="card-footer bg-primary ">
            <h5>Total Photos: {{ $product_photos->total() }}</h5>
        </div>
    </div>
@endsection