@extends('layouts.backend')

@section('subcategory', 'active')

@section('page_title', 'Add Subcategory')

@section('content')
    <div class="page-header">
        <div>
            <h3>Add New Subcategory</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.subcategories.index') }}">Subcategories</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Subcategory</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Subcategory</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.subcategories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_id">Parent Category</label>
                            <select name="category_id" id="category_id"
                                class="form-control select2-example @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Select a Category --</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Subcategory Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Enter subcategory name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Add Subcategory</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('exta_js')
    <script>
        $(document).ready(function() {
            $('.select2-example').select2({
                placeholder: 'Select an option'
            });
        });
    </script>
@endsection