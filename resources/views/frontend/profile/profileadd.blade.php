@extends('layouts.backend')

{{-- nav active satatus --}}
@section('profile')
    active
@endsection

{{-- title name --}}
@section('page_title')
    profile Add
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
            <h3>Add profile Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('front.profile.index') }}">profile</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Add profile Page</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="col-md-6 col-sm-8 col-lg-5 col-xl-4 m-auto">

        @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="ti-check mr-2"></i> {{ session()->get('success') }}
    </div>
    @endif

    <div class="card text-dark border border-primary">
        <div class="card-header bg-primary">profile Add++</div>
        <div class="card-body">
            <form action="{{ route('front.profile.add_user_insert') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- name --}}
                <div class="form-group">
                     <label>Name</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter New profile Name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- email --}}
                <div class="form-group">
                     <label>Email</label>
                    <input name="email" value="{{ old('email') }}" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter New profile email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- password  confirmation --}}
                <div class="form-group">
                     <label>Password Confirmation</label>
                    <input name="password" value="{{ old('password_confirmation') }}" type="text" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter Password Confirmation ">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- select option  --}}
                <label>Select Role</label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}">
                        <option value="">Select</option>
                        <option {{ old('role') == 1 ? "selected" : "" }} value="1">curstomer</option>
                        <option {{ old('role') == 2 ? "selected" : "" }} value="2">Salesmen</option>
                        <option {{ old('role') == 3 ? "selected" : "" }} value="3">Admin</option>
                        <option {{ old('role') == 4 ? "selected" : "" }} value="4">Superadmin</option>
                </select>
                    @error('role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror




                <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
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
        $('#category').change(function(){
            var id = $('#category').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type : 'POST',
                    url : '/addprofile/getsubcategory',
                    data : {id:id},
                    success : function(data){
                        $('#subcategory').html(data);

                    }
                });
            });



    </script>
@endsection
