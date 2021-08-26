@extends('layouts.backend')

{{-- nav active satatus --}}
@section('product')
    active
@endsection

{{-- title name --}}
@section('page_title')
    product photo
@endsection




@section('content')
    <div class="page-header">
        <div>
            <h3>product photo Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('product') }}">product</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">product_photo Page</li>
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
                <a class="nav-link btn btn-primary mr-2" href="{{ url('product/addproductphoto') }}/{{ $id }}">Add New{{ $id }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link btn btn-danger mr-2 {{ $product_photos_count == 0 ? "disabled" : "" }}" href="{{ route('product_photo_delete_all') }}">All Delete</a>
            </li>
        </ul>

    </div>


    <div class="card text-center border border-primary">
        <div class="card-header bg-primary">
            <h5>product_photo Item</h5>
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product</th>
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
                            <td> {{ App\Models\Product::find($item->product)->name }}</td>




                            <td>
                                <ul>
                                    <li>Added By :
                                        {{ App\Models\User::find($item->added_by)->name }}
                                    </li>
                                    <li>Active Status :
                                        @if ($item->action == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Deactive</span>
                                        @endif
                                    </li>

                                    <li>Created At :

                                        @if ($item->created_at->diffInDays() >= 30)
                                        <span class="badge badge-dark">
                                            {{ $item->created_at->format('d M, Y') }}
                                        </span>
                                        @elseif ($item->created_at->diffInDays() >= 2)
                                        <span class="badge badge-info">
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                        @else
                                            <span class="badge badge-danger">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                        @endif
                                        @if ($item->created_at->diffInDays() <= 2)
                                            <span class="badge badge-primary">new</span>
                                        @endif

                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('product/product_photo/delete') }}/{{ $item->id }}" class="btn btn-danger">
                                        <i class="ti-trash"></i>
                                    </a>
                                    @if ($item->action == 1)
                                    <a href="{{ url('product/product_photo/action') }}/{{ $item->id }}" class="btn btn-primary">
                                        <i class="ti-na"></i>
                                    </a>
                                    @else
                                    <a href="{{ url('product/product_photo/action') }}/{{ $item->id }}" class="btn btn-success">
                                        <i class="ti-eye"></i>
                                    </a>
                                    @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                      @empty
                        <tr colspan="50">
                            <td colspan="15" class="text-danger">No Data to Show</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{-- {{ $product_photos->links() }} --}}
        </div>

        <div class="card-footer bg-primary ">
            <h5>Total product photo: {{ $product_photos_count }}</h5>
        </div>
    </div>
@endsection
