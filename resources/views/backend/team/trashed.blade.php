@extends('layouts.backend')

{{-- nav active satatus --}}
@section('team')
    active
@endsection

{{-- title name --}}
@section('page_title')
    Team Recycle Bin
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>Team Recycle Bin</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.teams.index') }}">Team</a>
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
 @if(session()->has('error'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="ti-close mr-2"></i> {{ session()->get('error') }}
    </div>
@endif

    <div class="card text-center border border-primary p-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn btn-primary mr-2" href="{{ route('admin.teams.index') }}">Back to Team</a>
            </li>
        </ul>
    </div>

    <div class="card text-center border border-primary">
        <div class="card-header bg-primary">
            <h5>Trashed Team Members</h5>
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($teams as $key => $item)
                        <tr>
                            <th>{{ $teams->firstItem() + $key }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <figure class="avatar">
                                    <img src="{{ asset('upload/team') }}/{{ $item->img }}" alt="avatar">
                                </figure>
                            </td>
                            <td>
                                <ul>
                                    <li>Added By : {{ $item->user->name ?? 'N/A' }}</li>
                                    <li>Deleted At : {{ $item->deleted_at->diffForHumans() }}</li>
                                </ul>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('admin.teams.restore', $item) }}" method="POST" class="mr-2">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                    <form action="{{ route('admin.teams.forceDelete', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No trashed team members found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $teams->links() }}
        </div>
        <div class="card-footer bg-primary ">
            <h5>Total Trashed Team Members: {{ $teams->total() }}</h5>
        </div>
    </div>
@endsection