@extends('layouts.backend')

<!-- Nav active satatus -->
@section('category', 'active')

<!-- title name -->
@section('page_title', 'Category')



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
        <form action="{{ route('category_form_action') }}" method="POST">
            @csrf
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary mr-2" href="{{ route('admin.categories.create') }}">Add New</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-dark mr-2" href="{{ route('recyclebin_category') }}">Recycle Bin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger mr-2" href="{{ route('category_p_delete_all') }}">All P. Delete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-info mr-2" href="{{ route('category_soft_delete_all') }}">All S. Delete</a>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-secondary mr-1" type="submit" name="action" value="mark_p_delete">Mark P. Delete</button>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-warning mr-1" type="submit" name="action" value="mark_s_delete">Mark S. Delete</button>
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
                            <th scope="row"><input type="checkbox" name="check[]" value="{{ $item->id }}"></th>
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
                                        <a href="{{ route('admin.categories.edit', $item->id) }}" class="dropdown-item text-info">Update</a>
                                        <a href="{{ url('category/soft_delete') }}/{{ $item->id }}" class="dropdown-item text-warning">Delete</a>
                                        <a href="{{ url('category/p_delete') }}/{{ $item->id }}" class="dropdown-item text-danger">Permanent Delete</a>
                                        @if ($item->action == 1)
                                        <a href="{{ url('category/action') }}/{{ $item->id }}" class="dropdown-item text-primary">Dactive</a>
                                        @else

                                        <a href="{{ url('category/action') }}/{{ $item->id }}" class="dropdown-item text-success">Active</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
            </div>
            {{ $categories->links() }}
        </div>

        <div class="card-footer bg-primary ">
            <h5>Total Catagory: {{ $categories->count()}}</h5>
        </div>
    </div>
@endsection
