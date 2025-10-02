@extends('layouts.backend')

{{-- nav active satatus --}}
@section('team')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Team Update
@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Update Team Member Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.teams.index') }}">Team</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Team Member</li>
                </ol>
            </nav>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="ti-check mr-2"></i> {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="ti-close mr-2"></i> {{ session()->get('error') }}
        </div>
    @endif

<div class="col-md-6 col-sm-8 col-lg-5 col-xl-6 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Update Team Member</div>
        <div class="card-body">
            <form action="{{ route('admin.teams.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group text-center">
                    <figure class="avatar avatar-xl">
                       <img class="rounded" src="{{ asset('upload/team') }}/{{ $item->img }}" alt="avatar">
                    </figure>
                </div>
                <!-- File input -->
                <div class="form-group">
                    <label>Select New Member Image</label>
                    <input name="img" type="file" class="form-control-file @error('img') is-invalid @enderror">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>Name</label>
                    <input name="name" value="{{ $item->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>Title</label>
                    <input name="title" value="{{ $item->title }}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection