@extends('layouts.backend')

@section('cupon', 'active')

@section('page_title', 'Update Coupon')

@section('content')
    <div class="page-header">
        <div>
            <h3>Update Coupon</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.cupons.index') }}">Coupons</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Coupon</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Update Coupon</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cupons.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Coupon Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $item->name) }}" placeholder="Enter coupon name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" name="code" id="code"
                                class="form-control @error('code') is-invalid @enderror"
                                value="{{ old('code', $item->code) }}" placeholder="Enter coupon code" required>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount (%)</label>
                            <input type="number" name="discount" id="discount"
                                class="form-control @error('discount') is-invalid @enderror"
                                value="{{ old('discount', $item->discount) }}" placeholder="Enter discount percentage"
                                required>
                            @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Expiration Date</label>
                            <input type="date" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date', $item->date) }}" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection