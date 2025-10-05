@extends('layouts.backend')

{{-- nav active satatus --}}
@section('product')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Product
@endsection

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
    @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="ti-check mr-2"></i> {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('warning'))
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <i class="ti-help mr-2"></i> {{ session()->get('warning') }}
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
                <a class="nav-link btn btn-primary mr-2" href="{{ route('admin.products.create') }}">Add New</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-dark mr-2" href="{{ route('admin.products.trashed') }}">Recycle Bin</a>
            </li>
        </ul>
    </div>

    <div class="card text-center border border-primary">
        <div class="card-header bg-primary">
            <h5>Product Item</h5>
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product Photo</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
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
                                    <img src="{{ asset('upload/product') }}/{{ $item->img }}" alt="avatar">
                                </figure>
                            </td>
                            <td>
                                <a href="{{ route('admin.products.photos.index', $item->id) }}">
                                    <div class="avatar-group">
                                        @foreach ($item->photos->take(3) as $product_photo)
                                            <figure class="avatar">
                                                <img src="{{ asset('upload/product_photo') }}/{{ $product_photo->img }}" class="rounded-circle" alt="avatar">
                                            </figure>
                                        @endforeach
                                    </div>
                                </a>
                            </td>
                            <td>
                                <ul>
                                    @if ($item->discount != null)
                                    <li>Discount : {{ $item->discount }}%</li>
                                    @endif
                                    <li>Subcategory : {{ $item->subcategory_info->name ?? 'N/A' }}</li>
                                    <li>Category : {{ $item->category_info->name ?? 'N/A' }}</li>
                                    <li>Quantity : {{ $item->quantity }}</li>
                                    @if ($item->notification_quantity != null)
                                    <li>Notification Quantity : {{ $item->notification_quantity }}</li>
                                    @endif
                                    <li>Added By : {{ $item->user->name ?? 'N/A' }}</li>
                                    <li>Created At : {{ $item->created_at->diffForHumans() }}</li>
                                </ul>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.products.show', $item->id) }}" class="btn btn-primary btn-sm mr-2">View</a>
                                    <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-info btn-sm mr-2">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-danger">No Data to Show</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}
        </div>
        <div class="card-footer bg-primary">
            <h5>Total Products: {{ $products->total() }}</h5>
        </div>
    </div>
@endsection