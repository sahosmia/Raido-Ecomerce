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
            <h3>Add cupon Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.cupons.index') }}">cupon</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Add cupon Page</li>
                </ol>
            </nav>
        </div>
    </div>


<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">cupon Add++</div>
        <div class="card-body">
            <form action="{{ route('admin.cupons.store') }}" method="post" enctype="multipart/form-data">
                @csrf


                {{-- name --}}
                <div class="form-group">
                     <label>Cupon Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New cupon Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- code  --}}
                <div class="form-group">
                     <label>Cupon Code</label>
                    <input name="code" value="{{ old('code') }}" type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Enter New cupon code">
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
                     <label>Cupon End Date <span class="text-danger">(*optional)</span></label>
                     <label>Date</label>
                     @php
                        use Carbon\Carbon;
                        $date = Carbon::now()->format('Y-m-d');
                     @endphp

                     <input name="date"  value="{{ $date }}"  type="date" class="form-control @error('date') is-invalid @enderror">
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


