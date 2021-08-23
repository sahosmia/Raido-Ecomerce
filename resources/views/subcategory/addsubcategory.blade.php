@extends('layouts.backend')

{{-- nav active satatus --}}
@section('subcategory')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Subcategory Add
@endsection

{{-- exta css  --}}
@section('exta_css')

<!-- Style -->
<link rel="stylesheet" href="{{ asset('backend/vendors/select2/css/select2.min.css') }}" type="text/css">

@endsection

{{-- content --}}
@section('content')
    <div class="page-header">
        <div>
            <h3>Add subcategory Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('subcategory') }}">Subcategory</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Add Subcategory Page</li>
                </ol>
            </nav>
        </div>
    </div>


<div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">
    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">Subcategory Add++</div>
        <div class="card-body">
            <form action="{{ route('addsubcategoryinsert') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- select option  --}}
                <div class="form-group">
                    <label>Select Category</label>
                     <select class="select2-example @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="">Select</option>
                        @foreach ($categories as $item)
                        <option {{ old('category_id') == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                     <label>New Subcategory Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New subcategory Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                     @if(session()->has('error_status'))
                        <small class="text-danger">
                            {{ session()->get('error_status') }}
                        </small>
                    @endif
                </div>



                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection




{{-- exta js  --}}
@section('exta_js')


    <!-- select -->
    <script src="{{ asset('backend/vendors/select2/js/select2.min.js') }}"></script>

    <script>

        // select2
        $('.select2-example').select2({
            placeholder: 'Select'
        });
    </script>
@endsection
