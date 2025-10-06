@extends('layouts.frontend')

@section('page_title', 'My Account')

@section('content')
    @include('include.frontend.page_header', ['name' => 'My Account'])
    <!-- End PageHeader -->

    <main class="main account">
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('front.index') }}"><i class="d-icon-home"></i></a></li>
                    <li>Account</li>
                </ul>
            </div>
        </nav>
        <div class="page-content mt-4 mb-10 pb-6">
            <div class="container">
                <x-alert />
                <div class="tab tab-vertical gutter-lg">
                    <ul class="nav nav-tabs mb-4 col-lg-3 col-md-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#orders">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#account">Account Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    <div class="tab-content col-lg-9 col-md-8">
                        <div class="tab-pane active" id="dashboard">
                            <p class="mb-2">Hello, {{ Auth::user()->name }}!</p>
                            <p class="mb-2">From your account dashboard you can view your recent orders, manage your
                                shipping and billing addresses, and edit your password and account details.</p>
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <div class="card card-address">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase">Billing Address</h5>
                                            <p>{{ Auth::user()->address ?? 'You have not set up this type of address yet.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <div class="card card-address">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase">Shipping Address</h5>
                                            <p>You have not set up this type of address yet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="orders">
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th class="pl-2">Order</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th class="pr-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($order_details as $item)
                                        <tr>
                                            <td class="order-number"><a href="#">#{{ $item->id }}</a></td>
                                            <td class="order-date">
                                                <time>{{ $item->created_at->format('d M, Y') }}</time>
                                            </td>
                                            <td class="order-status"><span>On hold</span></td>
                                            <td class="order-total"><span>${{ $item->total }} for
                                                    {{ $item->orders_count }} items</span></td>
                                            <td class="order-action"><a
                                                    href="{{ route('front.order.show', $item->cookie) }}"
                                                    class="btn btn-primary btn-link btn-underline">View</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="account">
                            <form action="{{ route('front.profile.update') }}" method="post" class="form"
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <legend>Profile Details</legend>
                                    <div class="form-group">
                                        <label for="img">Profile Image</label>
                                        <input type="file" id="img" class="form-control" name="img">
                                        @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Full Name *</label>
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="{{ old('name', Auth::user()->name) }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="email" id="email" class="form-control" name="email"
                                            value="{{ old('email', Auth::user()->email) }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" class="form-control" name="address"
                                            value="{{ old('address', Auth::user()->address) }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" id="phone" class="form-control" name="phone"
                                                    value="{{ old('phone', Auth::user()->phone) }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="blood">Blood Group</label>
                                                @php
                                                    $blood_groups = ['O+', 'A+', 'B+', 'AB+', 'O-', 'A-', 'B-', 'AB-'];
                                                @endphp
                                                <select id="blood" class="form-control" name="blood">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($blood_groups as $group)
                                                        <option value="{{ $group }}"
                                                            {{ old('blood', Auth::user()->blood) == $group ? 'selected' : '' }}>
                                                            {{ $group }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('blood')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="btn_name" value="all" class="btn btn-primary">Save
                                        Changes</button>
                                </fieldset>
                            </form>

                            <form action="{{ route('front.profile.update') }}" method="post" class="form mt-8">
                                @csrf
                                <fieldset>
                                    <legend>Password Change</legend>
                                    <div class="form-group">
                                        <label for="old_password">Current Password (leave blank to leave
                                            unchanged)</label>
                                        <input type="password" id="old_password" class="form-control"
                                            name="old_password">
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password (leave blank to leave unchanged)</label>
                                        <input type="password" id="password" class="form-control" name="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm New Password</label>
                                        <input type="password" id="password_confirmation" class="form-control"
                                            name="password_confirmation">
                                    </div>
                                </fieldset>
                                <button type="submit" name="btn_name" value="password_change"
                                    class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('exta_js')
    <script src="{{ asset('frontend/vendor/sticky/sticky.min.js') }}"></script>
@endsection