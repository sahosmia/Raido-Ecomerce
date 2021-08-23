@extends('layouts.backend')

{{-- nav active satatus --}}
@section('brand')
    active
@endsection

{{-- title name --}}
@section('page_title')
    brand Update
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

                    <li class="breadcrumb-item active" aria-current="page">Update brand Page</li>
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


<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Image</div>
        <div class="card-body">
            <form action="{{ route('brand_img_update') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <input name="id" type="hidden" value="{{ $item->id }}">
                 <figure class="avatar avatar-xl">
                    <img class="" src="{{ asset('upload/brand') }}/{{ $item->img }}" alt="avatar">
                 </figure>
                <!-- File input -->
                <div class="form-group">
                    <label>Select brand Image</label>
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
<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">All Update</div>
        <div class="card-body">
            <form action="{{ route('brand_update') }}" method="post">
                @csrf
                <input name="id" type="hidden" value="{{ $item->id }}">
                <div class="form-group">
                     <label>New brand Name</label>
                    <input name="name" value="{{ $item->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New brand Name">
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



