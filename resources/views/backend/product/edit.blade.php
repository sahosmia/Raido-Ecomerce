@extends('layouts.backend')

{{-- nav active satatus --}}
@section('product')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Product Update
@endsection
{{-- exta css  --}}
@section('exta_css')
<!-- Style -->
<link rel="stylesheet" href="{{ asset('backend/vendors/select2/css/select2.min.css') }}" type="text/css">
@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Update Product Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Product</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Product Page</li>
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

    <div class="col-md-8 col-sm-10 col-lg-8 col-xl-8 m-auto">
        <div class="card text-dark border border-primary">
            <div class="card-header bg-primary">Update Product</div>
            <div class="card-body">
                <form action="{{ route('admin.products.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        {{-- Image Preview --}}
                        <div class="form-group col-md-12 text-center">
                            <figure class="avatar avatar-xl">
                                <img class="rounded" src="{{ asset('upload/product') }}/{{ $item->img }}" alt="avatar">
                            </figure>
                        </div>

                        <!-- File input -->
                        <div class="form-group col-md-12">
                            <label>Select New Product Image</label>
                            <input name="img" type="file" class="form-control-file">
                            @error('img')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- category  --}}
                        <div class="form-group col-md-6">
                            <label>Select Category</label>
                            <select id="category" class="select2-example @error('category') is-invalid @enderror" name="category" >
                                <option value="">Select</option>
                                @foreach ($categories as $catagory)
                                <option {{ $item->category == $catagory->id ? "selected" : "" }} value="{{ $catagory->id }}">{{ $catagory->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- subcategory --}}
                        <div class="form-group col-md-6">
                            <label>Select Subcategory</label>
                            <select id="subcategory" class="select2-example @error('subcategory') is-invalid @enderror" name="subcategory">
                                @foreach ($subcategories as $subcategory)
                                <option {{ $item->subcategory == $subcategory->id ? "selected" : "" }} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                            @error('subcategory')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- name --}}
                        <div class="form-group col-md-6">
                            <label>Product Name</label>
                            <input name="name" value="{{ $item->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Product Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- price --}}
                        <div class="form-group col-md-6">
                            <label>Product price</label>
                            <input name="price" value="{{ $item->price }}" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Product price">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Product Quantity --}}
                        <div class="form-group col-md-4">
                            <label>Product Quantity</label>
                            <input name="quantity" value="{{ $item->quantity }}" type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="Enter Product quantity">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Discount --}}
                        <div class="form-group col-md-4">
                            <label>Discount</label>
                            <input name="discount" value="{{ $item->discount }}" type="number" class="form-control @error('discount') is-invalid @enderror" placeholder="Enter Product discount">
                            @error('discount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Notification Quantity --}}
                        <div class="form-group col-md-4">
                            <label>Notification Quantity</label>
                            <input name="notification_quantity" value="{{ $item->notification_quantity }}" type="number" class="form-control @error('notification_quantity') is-invalid @enderror" placeholder="Enter Product notification_quantity">
                            @error('notification_quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Textarea -->
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea name="des" class="form-control @error('des') is-invalid @enderror" rows="3">{{ $item->des }}</textarea>
                            @error('des')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- exta js  --}}
@section('exta_js')
    <!-- select -->
    <script src="{{ asset('backend/vendors/select2/js/select2.min.js') }}"></script>
    <script>
        // select2
        $('.select2-example').select2({
            placeholder: 'Select'
        });

        $('#category').change(function(){
            var id = $('#category').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type : 'POST',
                url : '{{ route("admin.products.getSubcategories") }}',
                data : {id:id},
                success : function(data){
                    $('#subcategory').html(data);
                }
            });
        });
    </script>
@endsection