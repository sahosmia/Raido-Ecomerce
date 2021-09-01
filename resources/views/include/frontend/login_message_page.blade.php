@extends('layouts.frontend')
@section('content')
<div class="container mt-10 mb-10 m-auto">
    <div class="row">

           <div class="alert alert-primary alert-simple alert-btn">
            <a href="{{ route('login') }}" class="btn btn-primary btn-md btn-rounded">Log IN</a>
            Please Log In first
            <button type="button" class="btn btn-link btn-close">
                <i class="d-icon-times"></i>
            </button>
           </div>

    </div>
</div>
@endsection









