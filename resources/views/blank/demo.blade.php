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


    <div class="card text-center p-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary mr-2" href="#">Add New</a>
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




    <div class="card text-center">
        <div class="card-header bg-primary">
           Category Item
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Mark</th>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Details</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <th scope="row"><input type="checkbox" name="check"></th>
                        <th>2</th>
                        <td>Toys</td>
                        <td>Baby</td>
                        <td>
                            <ul>
                                <li>Active Status : <span class="badge badge-warning">Pending</span></li>
                                <li>Added By : Sahos</li>
                                <li>Created At : <span class="badge badge-warning">20 minit ago</span></li>
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
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>the Bird</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown"
                                    class="btn btn-floating"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-more-alt"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item">View Detail</a>
                                    <a href="#" class="dropdown-item">Send</a>
                                    <a href="#" class="dropdown-item">Download</a>
                                    <a href="#" class="dropdown-item">Print</a>
                                    <a href="#" class="dropdown-item text-danger">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    </tbody>

                </table>
            </div>
        </div>

        <div class="card-footer bg-primary ">
            Total : 20
        </div>
    </div>
@endsection
