@extends('layouts.backend')

@section('product', 'active')

@section('page_title', 'Add Product')

@section('content')
    <div class="page-header">
        <div>
            <h3>Add New Product</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="category">Category</label>
                                <select id="category" name="category"
                                    class="form-control select2-example @error('category') is-invalid @enderror" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category') == $item->id ? 'selected' : '' }}>{{ $item->name }}
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
                                    <option value="">-- Select Category First --</option>
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
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Enter product name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" placeholder="Enter price" required>
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
                                    value="{{ old('quantity') }}" placeholder="Enter quantity" required>
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="discount">Discount (%)</label>
                                <input type="number" name="discount" id="discount"
                                    class="form-control @error('discount') is-invalid @enderror"
                                    value="{{ old('discount') }}" placeholder="Enter discount percentage">
                                @error('discount')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="notification_quantity">Alert Quantity</label>
                                <input type="number" name="notification_quantity" id="notification_quantity"
                                    class="form-control @error('notification_quantity') is-invalid @enderror"
                                    value="{{ old('notification_quantity') }}" placeholder="Stock alert level">
                                @error('notification_quantity')
                                    <span class="invalid-feedback"
                                        role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="des">Description</label>
                            <textarea name="des" id="des" class="form-control @error('des') is-invalid @enderror"
                                rows="4" placeholder="Enter product description"
                                required>{{ old('des') }}</textarea>
                            @error('des')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="img">Featured Image</label>
                                <div class="custom-file">
                                    <input type="file" name="img" id="img"
                                        class="custom-file-input @error('img') is-invalid @enderror" required>
                                    <label class="custom-file-label" for="img">Choose file...</label>
                                </div>
                                @error('img')
                                    <span class="invalid-feedback d-block"
                                        role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="img_multiple">Additional Images</label>
                                <div class="custom-file">
                                    <input type="file" name="img_multiple[]" id="img_multiple"
                                        class="custom-file-input @error('img_multiple.*') is-invalid @enderror" multiple>
                                    <label class="custom-file-label" for="img_multiple">Choose files...</label>
                                </div>
                                @error('img_multiple.*')
                                    <span class="invalid-feedback d-block"
                                        role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Add Product</button>
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