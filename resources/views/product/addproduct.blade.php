@extends('layouts.backend')

{{-- nav active satatus --}}
@section('product')
    active
@endsection

{{-- title name --}}
@section('page_title')
    product Add
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
            <h3>Add product Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('product') }}">product</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Add product Page</li>
                </ol>
            </nav>
        </div>
    </div>


<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">product Add++</div>
        <div class="card-body">
            <form action="{{ route('addproductinsert') }}" method="post" enctype="multipart/form-data">
                @csrf
      {{-- select option  --}}
                <div class="form-group">
                     <label>Select Category</label>
                     <select class="select2-example @error('category') is-invalid @enderror" name="category" >
                        <option value="">Select</option>
                         @foreach ($categories as $item)
                        <option {{ old('category') == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                      {{-- select option  --}}
                <div class="form-group">
                     <label>Select Subcategory</label>
                     <select class="select2-example @error('subcategory') is-invalid @enderror" name="subcategory">
                        <option value="">Select</option>
                         @foreach ($subcategories as $item)
                        <option {{ old('subcategory') == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }} --- {{ $categories->find($item->category)->name }}</option>
                        @endforeach
                    </select>
                    @error('subcategory')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                     <label>New Product Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New Product Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                     <label>Product price</label>
                    <input name="price" value="{{ old('price') }}" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Enter New Product price">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                     <label>Product Quantity</label>
                    <input name="quantity" value="{{ old('quantity') }}" type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="Enter New Product quantity">
                    @error('quantity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                     <label>Discount</label>
                    <input name="discount" value="{{ old('discount') }}" type="number" class="form-control @error('discount') is-invalid @enderror" placeholder="Enter New Product discount">
                    @error('discount')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>Notification Quantity</label>
                    <input name="notification_quantity" value="{{ old('notification_quantity') }}" type="number" class="form-control @error('notification_quantity') is-invalid @enderror" placeholder="Enter New Product notification_quantity">
                    @error('notification_quantity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
  <!-- Textarea -->
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="des" class="form-control @error('des') is-invalid @enderror" rows="3">{{ old('des') }}</textarea>
                    @error('des')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                   <!-- File input -->
                <div class="form-group">
                    <label>Select product Image</label>
                    <input name="img" value="{{ old('img') }}" type="file" class="form-control-file">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
    </script>
@endsection
