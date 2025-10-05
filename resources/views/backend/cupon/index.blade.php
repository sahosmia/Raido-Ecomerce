@extends('layouts.backend')

{{-- nav active satatus --}}
@section('cupon')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Cupon
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>Cupon Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Cupon Page</li>
                </ol>
            </nav>
        </div>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="ti-check mr-2"></i> {{ session()->get('success') }}
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
                <a class="nav-link btn btn-primary mr-2" href="{{ route('admin.cupons.create') }}">Add New</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-dark mr-2" href="{{ route('admin.cupons.trashed') }}">Recycle Bin</a>
            </li>
        </ul>
    </div>

    <div class="card text-center border border-primary">
        <div class="card-header bg-primary">
            <h5>Cupon Item</h5>
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">Discount</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($cupons as $key => $item)
                        <tr>
                            <th>{{ $cupons->firstItem() + $key }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->discount }}%</td>
                            <td>{{ $item->end_cupon }}</td>
                            <td>
                                <ul>
                                    <li>Added By : {{ $item->user->name ?? 'N/A' }}</li>
                                    <li>Created At : {{ $item->created_at->diffForHumans() }}</li>
                                </ul>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.cupons.edit', $item->id) }}" class="btn btn-info btn-sm mr-2">Edit</a>
                                    <form action="{{ route('admin.cupons.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-danger">No Data to Show</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $cupons->links() }}
        </div>
        <div class="card-footer bg-primary ">
            <h5>Total Cupons: {{ $cupons->total() }}</h5>
        </div>
    </div>
@endsection