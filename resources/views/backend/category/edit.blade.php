@extends('layouts.backend')

@section('category', 'active')

@section('page_title', 'Update Category')

@section('content')
    <div class="page-header">
        <div>
            <h3>Update Category</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">Categories</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Category</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Update Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $item) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group text-center">
                            <figure class="avatar avatar-xl">
                                <img class="rounded" src="{{ asset('upload/category/' . $item->img) }}"
                                    alt="Current Category Image">
                            </figure>
                        </div>

                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $item->name) }}" placeholder="Enter category name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="img">Update Category Image (Optional)</label>
                            <div class="custom-file">
                                <input type="file" name="img" id="img"
                                    class="custom-file-input @error('img') is-invalid @enderror">
                                <label class="custom-file-label" for="img">Choose file...</label>
                            </div>
                            @error('img')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




