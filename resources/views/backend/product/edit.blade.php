@extends('layouts.backend')

@section('product', 'active')

@section('page_title', 'Update Product')

@section('content')
    <div class="page-header">
        <div>
            <h3>Update Product</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-alert />

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Update Product Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <figure class="avatar avatar-xl">
                                    <img class="rounded" src="{{ asset('upload/product/' . $item->img) }}"
                                        alt="Current Product Image">
                                </figure>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="category">Category</label>
                                <select id="category" name="category"
                                    class="form-control select2-example @error('category') is-invalid @enderror"
                                    required>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category', $item->category) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subcategory">Subcategory</label>
                                <select id="subcategory" name="subcategory"
                                    class="form-control select2-example @error('subcategory') is-invalid @enderror"
                                    required>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}"
                                            {{ old('subcategory', $item->subcategory) == $subcategory->id ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subcategory')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $item->name) }}" placeholder="Enter product name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $item->price) }}" placeholder="Enter price" required>
                                @error('price')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    value="{{ old('quantity', $item->quantity) }}" placeholder="Enter quantity"
                                    required>
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="discount">Discount (%)</label>
                                <input type="number" name="discount" id="discount"
                                    class="form-control @error('discount') is-invalid @enderror"
                                    value="{{ old('discount', $item->discount) }}"
                                    placeholder="Enter discount percentage">
                                @error('discount')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="notification_quantity">Alert Quantity</label>
                                <input type="number" name="notification_quantity" id="notification_quantity"
                                    class="form-control @error('notification_quantity') is-invalid @enderror"
                                    value="{{ old('notification_quantity', $item->notification_quantity) }}"
                                    placeholder="Stock alert level">
                                @error('notification_quantity')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="des">Description</label>
                            <textarea name="des" id="des" class="form-control @error('des') is-invalid @enderror"
                                rows="4" placeholder="Enter product description"
                                required>{{ old('des', $item->des) }}</textarea>
                            @error('des')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="img">Update Featured Image (Optional)</label>
                            <div class="custom-file">
                                <input type="file" name="img" id="img"
                                    class="custom-file-input @error('img') is-invalid @enderror">
                                <label class="custom-file-label" for="img">Choose file...</label>
                            </div>
                            @error('img')
                                <span class="invalid-feedback d-block"
                                    role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Update Product</button>
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

            $('#category').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '{{ route('admin.products.getSubcategories') }}',
                        type: 'POST',
                        data: {
                            id: categoryId,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'html',
                        success: function(data) {
                            $('#subcategory').html(data);
                        },
                        error: function() {
                            $('#subcategory').html(
                                '<option value="">-- Could not load subcategories --</option>'
                                );
                        }
                    });
                } else {
                    $('#subcategory').html('<option value="">-- Select Category First --</option>');
                }
            });
        });
    </script>
@endsection