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
            <form action="{{ route('addcategoryinsert') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                     <label>Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>Email</label>
                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                     <label>Password Confirmation</label>
                    <input name="password_confirmation" type="text" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter Password Confirmation ">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <!-- Textarea -->
                <div class="form-group">
                    <label>Example textarea</label>
                    <textarea name="des" class="form-control @error('des') is-invalid @enderror" rows="3"></textarea>
                    @error('des')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
               <!-- File input -->
                <div class="form-group">
                    <label>Example file input</label>
                    <input name="img" type="file" class="form-control-file">
                    @error('img')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

               <!-- File input -->
                <div class="form-group">
                    <label>Example Multiple file input</label>
                    <input name="img_multuple[]" type="file" class="form-control-file" multiple>
                    @error('img_multuple')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>




                <div class="form-group">
                     <label>Select Category</label>
                     <select class="select2-example @error('select_name') is-invalid @enderror" name="select_name">
                        <option>Select</option>
                        <option value="France">France</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Yemen">Yemen</option>
                        <option value="United States">United States</option>
                        <option value="China">China</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Bulgaria">Bulgaria</option>
                    </select>
                    @error('select_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>



                <div class="form-group">
                     <label>Date</label>
                     <input name="daterangepicker" type="text" class="form-control @error('daterangepicker') is-invalid @enderror">
                    @error('daterangepicker')
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

