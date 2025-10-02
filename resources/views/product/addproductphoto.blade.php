@extends('layouts.backend')

{{-- nav active satatus --}}
@section('product')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Add Product Photo
@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add Product Photo</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Product</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.photos.index', $product->id) }}">Product Photos</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product Photo</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
        <div class="card text-dark border border-primary">
            <div class="card-header bg-primary">Add New Photos</div>
            <div class="card-body">
                <form action="{{ route('admin.products.photos.store', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- File input multiple -->
                    <div class="form-group ">
                        <label>Select Multiple Files</label>
                        <input name="img_multiple[]" type="file" class="form-control-file" multiple>
                        @error('img_multiple.*')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @error('img_multiple')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection