@extends('layouts.frontend')
@section('exta_css')
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/nouislider/nouislider.min.css') }}">

@endsection
@section('content')
@include('include.frontend.page_header', ['name' => 'Acount'])
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

					<div class="tab tab-vertical gutter-lg">
						<ul class="nav nav-tabs mb-4 col-lg-3 col-md-4" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#profile">Acount</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="#orders">Orders</a>
							</li>


							<li class="nav-item">
								<a class="nav-link" href="#account">Account update</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('logout') }}" data-sidebar-target="#settings" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
							</li>
						</ul>
						<div class="tab-content col-lg-9 col-md-8">
                            <div class="tab-pane active" id="profile">
								<p class="mb-2">The following addresses will be used on the checkout page by default.
								</p>
								<div class="row">
									<div class="col-sm-6 mb-4">
										<div class="card card-address">
											<div class="card-body">
												<h5 class="card-title text-uppercase">Billing Address</h5>
												<p>{{ Auth::user()->name }}<br>
                                                    Riode Company<br>
                                                    Steven street<br>
                                                    El Carjon, CA 92020
												</p>
											</div>
										</div>
									</div>
									<div class="col-sm-6 mb-4">
										<div class="card card-address">
											<div class="card-body">
												<h5 class="card-title text-uppercase">Shipping Address</h5>
												<p>You have not set up this type of address yet.</p>
												<a href="#" class="btn btn-link btn-secondary btn-underline">Edit <i
														class="far fa-edit"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="tab-pane " id="orders">
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
                                        @foreach ($order_details as $item)
                                        <tr>
                                            <td class="order-number"><a href="#">#{{ $item->id }}</a></td>
                                            <td class="order-date"><time>{{ $item->created_at }}</time></td>
                                            <td class="order-status"><span>On hold</span></td>
                                            <td class="order-total"><span>${{ $item->total }} for {{ App\Models\Order::where('cookie', $item->cookie)->count()}} items</span></td>
                                            <td class="order-action"><a href="{{ url('front/order/view') }}/{{ $item->cookie }}" class="btn btn-primary btn-link btn-underline">View</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
							</div>
							<div class="tab-pane" id="account">
								<form action="{{ route('front.profile.update') }}" method="post" class="form" enctype="multipart/form-data">
                                    @csrf
                                @if(session()->has('success'))
                                    <div class="alert alert-success alert-dark alert-round alert-inline">
                                        <i class="fas fa-check"></i>
                                        {{ session()->get('success') }}
                                        <button type="button" class="btn btn-link btn-close">
                                            <i class="d-icon-times"></i>
                                        </button>
                                    </div>
                                @endif
                                    <fieldset>
                                        <legend>Profile Update</legend>
                                        <label>Update Profile Image</label>
                                        <input type="file" class="form-control" name="img">

                                        <label>Name</label>
                                        <input type="text" value="{{ Auth::user()->name }}" class="form-control" name="name">

                                        <label>Email</label>
                                        <input type="text" value="{{ Auth::user()->email }}" class="form-control" name="email">

                                        <label>Address</label>
                                        <input type="text" value="{{ Auth::user()->address ? Auth::user()->address : "" }}" class="form-control" name="address">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Facebook</label>
                                                <input type="text" value="{{ Auth::user()->facebook ? Auth::user()->facebook : "" }}" class="form-control" name="facebook">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Instragram</label>
                                                <input type="text" value="{{ Auth::user()->instragram ? Auth::user()->instragram : "" }}" class="form-control" name="instragram">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Linkedin</label>
                                                <input type="text" value="{{ Auth::user()->linkedin ? Auth::user()->linkedin : "" }}" class="form-control" name="linkedin">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Twitter</label>
                                                <input type="text" value="{{ Auth::user()->twitter ? Auth::user()->twitter : "" }}" class="form-control" name="twitter">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Phone</label>
                                                <input type="text" value="{{ Auth::user()->phone ? Auth::user()->phone : "" }}" class="form-control" name="phone">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Blood</label>
                                                <select id="my-select" class="form-control" name="blood">
                                                    <option value="">Blood Group Select</option>
                                                    <option {{ Auth::user()->blood == "o+" ? "selected" : "" }} value="{{ Auth::user()->blood ? Auth::user()->blood : "" }}">O+</option>
                                                    <option {{ Auth::user()->blood == "a+" ? "selected" : "" }} value="{{ Auth::user()->blood ? Auth::user()->blood : "" }}">A+</option>
                                                    <option {{ Auth::user()->blood == "b+" ? "selected" : "" }} value="{{ Auth::user()->blood ? Auth::user()->blood : "" }}">B+</option>
                                                    <option {{ Auth::user()->blood == "ab+" ? "selected" : "" }} value="{{ Auth::user()->blood ? Auth::user()->blood : "" }}">AB+</option>
                                                    <option {{ Auth::user()->blood == "o-" ? "selected" : "" }} value="{{ Auth::user()->blood ? Auth::user()->blood : "" }}">O-</option>
                                                    <option {{ Auth::user()->blood == "a-" ? "selected" : "" }} value="{{ Auth::user()->blood ? Auth::user()->blood : "" }}">A-</option>
                                                    <option {{ Auth::user()->blood == "b-" ? "selected" : "" }} value="{{ Auth::user()->blood ? Auth::user()->blood : "" }}">B-</option>
                                                    <option {{ Auth::user()->blood == "ab-" ? "selected" : "" }} value="{{ Auth::user()->blood ? Auth::user()->blood : "" }}">AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <button type="submit" name="btn_name" value="all" class="btn btn-primary">SAVE CHANGES</button>


                                     @if(session()->has('password_success'))
                                        <div class="alert alert-success alert-dark alert-round alert-inline">
                                            <i class="fas fa-check"></i>
                                            {{ session()->get('password_success') }}
                                            <button type="button" class="btn btn-link btn-close">
                                                <i class="d-icon-times"></i>
                                            </button>
                                        </div>
                                    @endif
                                    @if(session()->has('error'))
                                        <div class="alert alert-danger alert-dark alert-round alert-inline">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ session()->get('error') }}
                                            <button type="button" class="btn btn-link btn-close">
                                                <i class="d-icon-times"></i>
                                            </button>
                                        </div>
                                    @endif
                                    <fieldset>
                                        <legend>Password Change</legend>
                                        <label>Current password</label>
                                        <input type="password" class="form-control" name="old_password">

                                        <label>New password</label>
                                        <input type="password" class="form-control" name="password">

                                        <label>Confirm new password</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </fieldset>

									<button type="submit" name="btn_name" value="password_change" class="btn btn-primary">SAVE CHANGES</button>
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
    <script src="{{ asset('frontend/vendor/nouislider/nouislider.min.js') }}"></script>

@endsection





