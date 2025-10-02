@extends('layouts.backend')

{{-- nav active satatus --}}
@section('category')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Category Update
@endsection



{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add Category Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">Category</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Update Category Page</li>
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

<div class="col-md-6 col-sm-8 col-lg-5 col-xl-6 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Image</div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <figure class="avatar avatar-xl">
                <img class="rounded" src="{{ asset('upload/category') }}/{{ $item->img }}" alt="avatar">
                </figure>

                <div class="form-group">
                    <label>Select Category Image</label>
                    <input name="img" value="{{ old('img') }}" type="file" class="form-control-file">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                     <label>New Category Name</label>
                    <input name="name" value="{{ $item->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New Category Name">
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




