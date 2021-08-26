@extends('layouts.backend')

{{-- nav active satatus --}}
@section('product')
    active
@endsection

{{-- title name --}}
@section('page_title')
    product photo Add
@endsection



{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add product Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('product') }}">product</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Add product Page</li>
                </ol>
            </nav>
        </div>
    </div>


<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">product Add++</div>
        <div class="card-body">
            <form action="{{ route('addproductphotoinsert') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $id }}" name="product_id">
                <!-- File input multiple -->
                <div class="form-group ">
                    <label>Example Multiple file input</label>
                    <input name="img_multiple[]" value="{{ old('img_multiple') }}" type="file" class="form-control-file" multiple>
                    @error('img_multiple')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection


