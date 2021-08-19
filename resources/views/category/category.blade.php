@extends('layouts.backend')

{{-- nav active satatus --}}
@section('category')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Category
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>Category Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Category Page</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="card text-center border border-primary p-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary mr-2" href="{{ route('addcategory') }}">Add New</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-dark mr-2" href="#">Recycle Bin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger mr-2" href="#">All P. Delete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-info mr-2" href="#">All S. Delete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-secondary mr-1" href="#">Mark P. Delete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-warning mr-1" href="#">Mark S. Delete</a>
            </li>

        </ul>

    </div>

    <div class="card text-center border border-primary">
        <div class="card-header bg-primary">
            <h5>Category Item</h5>
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Mark</th>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category Image</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $key => $item)
                        <tr>
                            <th scope="row"><input type="checkbox" name="check"></th>
                            <th>{{ $categories->firstItem() + $key }}</th>
                            <td>{{ $item->name }}</td>
                            <td>
                                <figure class="avatar">
                                    <img src="{{ asset('upload/category') }}/{{ $item->img }}" alt="avatar">
                                </figure>
                                {{-- <figure class="avatar">
                                    <img class="rounded" src="{{ asset('backend/assets/media/image/photo2.jpg') }}" alt="avatar">
                                </figure>
                                <figure class="avatar">
                                    <img class="rounded-circle" src="{{ asset('backend/assets/media/image/photo2.jpg') }}" alt="avatar">
                                </figure> --}}
                            </td>
                            <td>
                                <ul>
                                    <li>Added By :
                                        @php
                                        echo App\Models\User::find($item->added_by)->name;

                                        @endphp
                                    </li>
                                    <li>Active Status :
                                        @if ($item->action == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Deactive</span>
                                        @endif
                                    </li>

                                    <li>Created At :

                                        @if ($item->created_at->diffInDays() >= 30)
                                        <span class="badge badge-dark">
                                            {{ $item->created_at->format('d M, Y') }}
                                        </span>
                                        @elseif ($item->created_at->diffInDays() >= 2)
                                        <span class="badge badge-info">
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                        @else
                                            <span class="badge badge-danger">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                        @endif
                                        @if ($item->created_at->diffInDays() <= 2)
                                            <span class="badge badge-primary">new</span>
                                        @endif

                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown"
                                        class="btn btn-floating"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ti-more-alt"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item">View Detail</a>
                                        <a href="#" class="dropdown-item text-info">Update</a>
                                        <a href="#" class="dropdown-item text-warning">Delete</a>
                                        <a href="#" class="dropdown-item text-danger">Permanent Delete</a>
                                        <a href="#" class="dropdown-item text-primary">Resotor</a>
                                        <a href="#" class="dropdown-item text-success">Active</a>
                                        <a href="#" class="dropdown-item text-secondary">Dactive</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $categories->links() }}
        </div>

        <div class="card-footer bg-primary ">
            <h5>Total Catagory: {{ $categories_count }}</h5>
        </div>
    </div>
@endsection
