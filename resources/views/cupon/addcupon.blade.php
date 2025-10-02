@extends('layouts.backend')

{{-- nav active satatus --}}
@section('cupon')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Cupon Add
@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add Cupon Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.cupons.index') }}">Cupon</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Cupon Page</li>
                </ol>
            </nav>
        </div>
    </div>

<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Cupon Add++</div>
        <div class="card-body">
            <form action="{{ route('admin.cupons.store') }}" method="post">
                @csrf
                {{-- name --}}
                <div class="form-group">
                     <label>Cupon Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New Cupon Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- code  --}}
                <div class="form-group">
                     <label>Cupon Code</label>
                    <input name="code" value="{{ old('code') }}" type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Enter New Cupon Code">
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- discount --}}
                <div class="form-group">
                     <label>Discount</label>
                    <input name="discount" value="{{ old('discount') }}" type="number" class="form-control @error('discount') is-invalid @enderror" placeholder="Enter New Cupon Discount">
                    @error('discount')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- end cupon --}}
                <div class="form-group">
                     <label>Cupon End Date</label>
                     <input name="date" value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}" type="date" class="form-control @error('date') is-invalid @enderror">
                    @error('date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection