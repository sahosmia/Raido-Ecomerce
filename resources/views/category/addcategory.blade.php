@extends('layouts.backend')

{{-- nav active satatus --}}
@section('category')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Category Add
@endsection

{{-- exta css  --}}
@section('exta_css')
<link rel="stylesheet" href="{{ asset('backend/vendors/datepicker/daterangepicker.css') }}">

<!-- Style -->
<link rel="stylesheet" href="{{ asset('backend/vendors/select2/css/select2.min.css') }}" type="text/css">

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

                    <li class="breadcrumb-item active" aria-current="page">Add Category Page</li>
                </ol>
            </nav>
        </div>
    </div>


<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Category Add++</div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
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




{{-- exta js  --}}
@section('exta_js')

    <!-- date picker -->
    <script src="{{ asset('backend/assets/js/examples/datepicker.js') }}"></script>

    <!-- select -->
    <script src="{{ asset('backend/vendors/select2/js/select2.min.js') }}"></script>

    <script>
        // date picker
        $('input[name="daterangepicker"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });

        // select2
        $('.select2-example').select2({
            placeholder: 'Select'
        });
    </script>
@endsection
