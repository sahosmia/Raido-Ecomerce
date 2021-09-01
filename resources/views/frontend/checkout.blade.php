

@extends('layouts.frontend')
@section('exta_css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('content')

{{-- {{ session('coupon_form_cart') }} --}}

<div class="page-content pt-7 pb-10 mb-10">
				<div class="step-by pr-4 pl-4">
					<h3 class="title title-simple title-step "><a href="{{ route('cart') }}">1. Shopping Cart</a></h3>
                    <h3 class="title title-simple title-step active"><a href="{{ route('checkout') }}">2. Checkout</a></h3>
                    <h3 class="title title-simple title-step"><a href="order.html">3. Order Complete</a></h3>
				</div>
				<div class="container mt-7">
					<form action="#" class="form">
						<div class="row">
							<div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
								<h3 class="title title-simple text-left text-uppercase">Billing Details</h3>
								<div class="row">
									<div class="col-xs-6">
										<label>First Name *</label>
										<input type="text" class="form-control" name="first-name" required="" />
									</div>
									<div class="col-xs-6">
										<label>Last Name *</label>
										<input type="text" class="form-control" name="last-name" required="" />
									</div>
								</div>
                                <div class="row">
									<div class="col-xs-6">
										<label>Country / Region *</label>
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
									</div>
									<div class="col-xs-6">
										<label>Country / Region *</label>
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
									</div>
								</div>
								<label>Street Address *</label>
								<input type="text" class="form-control" name="address1" required=""
									placeholder="House number and street name" />
								<div class="row">
									<div class="col-xs-6">
										<label>Town / City *</label>
										<input type="text" class="form-control" name="city" required="" />
									</div>
									<div class="col-xs-6">
										<label>State *</label>
										<input type="text" class="form-control" name="state" required="" />
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<label>ZIP *</label>
										<input type="text" class="form-control" name="zip" required="" />
									</div>
									<div class="col-xs-6">
										<label>Phone *</label>
										<input type="text" class="form-control" name="phone" required="" />
									</div>
								</div>
								<label>Email Address *</label>
								<input type="text" class="form-control" name="email-address" required="" />
							</div>
							<aside class="col-lg-5 sticky-sidebar-wrapper">
								<div class="sticky-sidebar mt-1" data-sticky-options="{'bottom': 50}">
									<div class="summary pt-5">
										<h3 class="title title-simple text-left text-uppercase">Your Order</h3>
										<table class="order-table">
											<thead>
												<tr>
													<th>Product</th>
													<th></th>
												</tr>
											</thead>
											<tbody>

                                                @php
                                                use App\Models\Product;
                                                use App\Models\Cupon;
                                                    $total = 0;
                                                    $status = true;
                                                @endphp
                                                @foreach ($cart_items as $item)
                                                @php
                                                if (Product::find($item->product)->discount) {
                                                    $price = Product::find($item->product)->price-Product::find($item->product)->discount*Product::find($item->product)->price/100;

                                                }
                                                else {
                                                    $price = Product::find($item->product)->price;
                                                }

                                                    $total +=  $price*$item->quantity;
                                                    $coupon = session('coupon_form_cart');
                                                    if ($coupon == "") {
                                                        $discount = 0;
                                                    } else {
                                                        if (Cupon::where('code', $coupon)->exists()) {
                                                            $discount = Cupon::where('code', $coupon)->first()->discount;
                                                        } else {
                                                            $discount = 0;
                                                            back()->with('error', 'this is not valid coupon');
                                                        }
                                                    }
                                                @endphp
												<tr>
													<td class="product-name">{{ Product::find($item->product)->name }} <span
															class="product-quantity">×&nbsp;{{ $item->quantity }}</span></td>
													<td class="product-total text-body">${{  $price*$item->quantity }}</td>
												</tr>
                                                @endforeach
                                                <tr class="summary-subtotal">
													<td>
														<h4 class="summary-subtitle">Subtotal</h4>
													</td>
													<td class="summary-subtotal-price pb-0 pt-0">${{ $total }}
													</td>
												</tr>
                                                <tr class="summary-subtotal">
													<td>
														<h4 class="summary-subtitle">Discount</h4>
													</td>
													<td class="summary-subtotal-price pb-0 pt-0">${{ $discount*$total/100 }}
													</td>
												</tr>
												<tr class="summary-total">
													<td class="pb-0">
														<h4 class="summary-subtitle">Total</h4>
													</td>
													<td class=" pt-0 pb-0">
														<p class="summary-total-price ls-s text-primary">${{ $total-$discount*$total/100 }}</p>
													</td>
												</tr>
                                                <tr class="sumnary-shipping shipping-row-last">
													<td colspan="2">
														<h4 class="summary-subtitle">Calculate Shipping</h4>
														<ul>
															<li>
																<div class="custom-radio">
																	<input type="radio" id="flat_rate"
																		name="shipping" class="custom-control-input" checked>
																	<label class="custom-control-label"
																		for="flat_rate">Flat rate</label>
																</div>
															</li>

															<li>
																<div class="custom-radio">
																	<input type="radio" id="free-shipping"
																		name="shipping" class="custom-control-input">
																	<label class="custom-control-label"
																		for="free-shipping">Free
																		shipping</label>
																</div>
															</li>

															<li>
																<div class="custom-radio">
																	<input type="radio" id="local_pickup"
																		name="shipping" class="custom-control-input">
																	<label class="custom-control-label"
																		for="local_pickup">Local pickup</label>
																</div>
															</li>
														</ul>
													</td>
												</tr>
											</tbody>
										</table>


										<button type="submit" class="btn btn-dark btn-rounded btn-order">Place Order</button>
									</div>
								</div>
							</aside>
						</div>
					</form>
				</div>
			</div>



@endsection
@section('exta_js')
    <script src="{{ asset('frontend/vendor/sticky/sticky.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@endsection







