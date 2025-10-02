@extends('layouts.backend')

{{-- nav active satatus --}}
@section('brand')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Brand Add
@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add Brand Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.brands.index') }}">Brand</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Brand Page</li>
                </ol>
            </nav>
        </div>
    </div>

<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Brand Add++</div>
        <div class="card-body">
            <form action="{{ route('admin.brands.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- File input -->
                <div class="form-group">
                    <label>Select Brand Image</label>
                    <input name="img" type="file" class="form-control-file @error('img') is-invalid @enderror">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>New Brand Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New Brand Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection