@extends('layouts.backend')

@section('product', 'active')

@section('page_title', 'Add Product Photos')

@section('content')
    <div class="page-header">
        <div>
            <h3>Add Photos to "{{ $product->name }}"</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.photos.index', $product) }}">Product Photos</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Photos</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Upload New Photos</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.photos.store', $product) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="img_multiple">Select Images (Multiple files allowed)</label>
                            <div class="custom-file">
                                <input type="file" name="img_multiple[]" id="img_multiple"
                                    class="custom-file-input @error('img_multiple.*') is-invalid @enderror" multiple
                                    required>
                                <label class="custom-file-label" for="img_multiple">Choose files...</label>
                            </div>
                            @error('img_multiple.*')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('img_multiple')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4">Upload Photos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection