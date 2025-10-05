@extends('layouts.backend')

{{-- nav active satatus --}}
@section('cupon')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Cupon Update
@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Update Cupon Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.cupons.index') }}">Cupon</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Cupon Page</li>
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

<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Update Cupon</div>
        <div class="card-body">
            <form action="{{ route('admin.cupons.update', $item->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                     <label>Cupon Name</label>
                    <input name="name" value="{{ $item->name }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New Cupon Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                  {{-- code  --}}
                <div class="form-group">
                     <label>Cupon Code</label>
                    <input name="code" value="{{ $item->code }}" type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Enter New Cupon Code">
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- discount --}}
                <div class="form-group">
                     <label>Discount</label>
                    <input name="discount" value="{{ $item->discount }}" type="number" class="form-control @error('discount') is-invalid @enderror" placeholder="Enter New Cupon Discount">
                    @error('discount')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- end cupon --}}
                <div class="form-group">
                     <label>Cupon End Date</label>
                     <input name="date" value="{{ $item->end_cupon }}" type="date" class="form-control @error('date') is-invalid @enderror">
                    @error('date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection