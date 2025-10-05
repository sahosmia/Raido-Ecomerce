@extends('layouts.backend')

{{-- nav active satatus --}}
@section('testimonial')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Testimonial Add
@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add Testimonial Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.testimonials.index') }}">Testimonial</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Testimonial Page</li>
                </ol>
            </nav>
        </div>
    </div>

<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Testimonial Add++</div>
        <div class="card-body">
            <form action="{{ route('admin.testimonials.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- File input -->
                <div class="form-group">
                    <label>Select Testimonial Image</label>
                    <input name="img" type="file" class="form-control-file @error('img') is-invalid @enderror">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- name  --}}
                <div class="form-group">
                     <label>Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- title --}}
                <div class="form-group">
                     <label>Title</label>
                    <input name="title" value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

               <!-- des -->
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="des" class="form-control @error('des') is-invalid @enderror" rows="3">{{ old('des') }}</textarea>
                    @error('des')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection