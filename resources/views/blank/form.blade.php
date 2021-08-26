@extends('layouts.backend')

{{-- nav active satatus --}}
@section('category')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Category
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
            <h3>Add Category Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('category') }}">Category</a>
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
            <form action="{{ route('blank_form_submit') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- name --}}
                <div class="form-group">
                     <label>Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- url --}}
                <div class="form-group">
                     <label>url</label>
                    <input name="url" value="{{ old('url') }}" type="text" class="form-control @error('url') is-invalid @enderror" placeholder="Enter url">
                    @error('url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- email  --}}
                <div class="form-group">
                     <label>Email</label>
                    <input name="email" value="{{ old('email') }}" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- password  --}}
                <div class="form-group">
                     <label>Password</label>
                    <input name="password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- password  confirmation --}}
                <div class="form-group">
                     <label>Password Confirmation</label>
                    <input name="password_confirmation" value="{{ old('password_confirmation') }}" type="text" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter Password Confirmation ">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <!-- Textarea -->
                <div class="form-group">
                    <label>Example textarea</label>
                    <textarea name="des" class="form-control @error('des') is-invalid @enderror" rows="3">{{ old('des') }}</textarea>
                    @error('des')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                  {{-- date picker --}}
                <div class="form-group">
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

               <!-- File input single -->
                <div class="form-group">
                    <label>Example file input</label>
                    <input name="img" value="{{ old('img') }}" type="file" class="form-control-file">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

               <!-- File input multiple -->
                <div class="form-group">
                    <label>Example Multiple file input</label>
                    <input name="img_multiple[]" value="{{ old('img_multiple') }}" type="file" class="form-control-file" multiple>
                    @error('img_multiple')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>



                {{-- select option  --}}
                <div class="form-group">
                     <label>Select Category</label>
                     <select class="select2-example @error('select_name') is-invalid @enderror" name="select_name" value="{{ old('select_name') }}">
                        <option>Select</option>
                         @foreach ($categories as $item)
                        <option {{ old('select_name') == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('select_name')
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

    <!-- select -->
    <script src="{{ asset('backend/vendors/select2/js/select2.min.js') }}"></script>

    <script>

        // select2
        $('.select2-example').select2({
            placeholder: 'Select'
        });
    </script>
@endsection

