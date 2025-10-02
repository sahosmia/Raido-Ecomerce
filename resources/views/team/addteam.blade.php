@extends('layouts.backend')

{{-- nav active satatus --}}
@section('team')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Team Add
@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add Team Member Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.teams.index') }}">Team</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Team Member</li>
                </ol>
            </nav>
        </div>
    </div>

<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Add Team Member</div>
        <div class="card-body">
            <form action="{{ route('admin.teams.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- File input -->
                <div class="form-group">
                    <label>Select Member Image</label>
                    <input name="img" type="file" class="form-control-file @error('img') is-invalid @enderror">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>Title</label>
                    <input name="title" value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection