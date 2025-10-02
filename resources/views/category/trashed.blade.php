@extends('layouts.backend')

{{-- nav active satatus --}}
@section('category')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Category Recycle Bin
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>Category Recycle Bin</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">Category</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Recycle Bin</li>
                </ol>
            </nav>
        </div>
    </div>
 @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="ti-check mr-2"></i> {{ session()->get('success') }}
    </div>
@endif

 @if(session()->has('warning'))
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <i class="ti-help mr-2"></i> {{ session()->get('warning') }}
    </div>
@endif
 @if(session()->has('error'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="ti-close mr-2"></i> {{ session()->get('error') }}
    </div>
@endif

    <div class="card text-center border border-primary p-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary mr-2" href="{{ route('admin.categories.index') }}">Back to Categories</a>
            </li>
        </ul>
    </div>

    <div class="card text-center border border-primary">
        <div class="card-header bg-primary">
            <h5>Trashed Category Items</h5>
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category Image</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($categories as $key => $item)
                        <tr>
                            <th>{{ $categories->firstItem() + $key }}</th>
                            <td>{{ $item->name }}</td>
                            <td>
                                <figure class="avatar">
                                    <img src="{{ asset('upload/category') }}/{{ $item->img }}" alt="avatar">
                                </figure>
                            </td>
                            <td>
                                <ul>
                                    <li>Added By :
                                        @php
                                        if($item->added_by) echo App\Models\User::find($item->added_by)->name;
                                        @endphp
                                    </li>
                                    <li>Deleted At :
                                        <span class="badge badge-danger">
                                            {{ $item->deleted_at->diffForHumans() }}
                                        </span>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('admin.categories.restore', $item->id) }}" method="POST" class="mr-2">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                    <form action="{{ route('admin.categories.forceDelete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No trashed categories found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $categories->links() }}
        </div>

        <div class="card-footer bg-primary ">
            <h5>Total Trashed Categories: {{ $categories->total() }}</h5>
        </div>
    </div>
@endsection