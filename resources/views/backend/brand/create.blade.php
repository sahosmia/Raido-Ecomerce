@extends('layouts.backend')

@section('brand', 'active')

@section('page_title', 'Add Brand')

@section('content')
    <div class="page-header">
        <div>
            <h3>Add Brand</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.brands.index') }}">Brands</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Brand</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Brand Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Enter brand name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="img">Brand Image</label>
                            <div class="custom-file">
                                <input type="file" name="img" id="img"
                                    class="custom-file-input @error('img') is-invalid @enderror" required>
                                <label class="custom-file-label" for="img">Choose file...</label>
                            </div>
                            @error('img')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection