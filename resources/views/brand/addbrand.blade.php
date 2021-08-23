@extends('layouts.backend')

{{-- nav active satatus --}}
@section('brand')
    active
@endsection

{{-- title name --}}
@section('page_title')
    brand Add
@endsection



{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add brand Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('brand') }}">brand</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Add brand Page</li>
                </ol>
            </nav>
        </div>
    </div>


<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">brand Add++</div>
        <div class="card-body">
            <form action="{{ route('addbrandinsert') }}" method="post" enctype="multipart/form-data">
                @csrf


                <!-- File input -->
                <div class="form-group">
                    <label>Select Category Image</label>
                    <input name="img" value="{{ old('img') }}" type="file" class="form-control-file">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>
                <div class="form-group">
                     <label>New Category Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New Category Name">

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


