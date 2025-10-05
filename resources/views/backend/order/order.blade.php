@extends('layouts.backend')

{{-- nav active satatus --}}
@section('order')
    active
@endsection

{{-- title name --}}
@section('page_title')
    order
@endsection




@section('content')
    <div class="page-header">
        <div>
            <h3>order Page</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">order Page</li>
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




    <div class="card text-center border border-primary">
        <div class="card-header bg-primary">
            <h5>order Item</h5>
        </div>
        <div class="card-body border-primary">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th>Order Id</th>
                            <th>Address</th>
                            <th>Product</th>
                            <th>Amount & Cupon</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use App\Models\Product;
                            use App\Models\Division;
                            use App\Models\District;
                            use App\Models\Cupon;
                            // use App\Models\Order_detail;
                        @endphp
                    @forelse ($order_details as $key => $item)
                        <tr>
                            <th>{{ $order_details->firstItem() + $key }}</th>
                            <th>{{ $item->id }}</th>
                            <td class="text-left">
                                <ul>
                                    @php
                                        $order_billing_details = App\Models\Order_billing_detail::where('cookie', $item->cookie)->first();
                                        $orders = App\Models\Order::where('cookie', $item->cookie)->get();
                                        $total = 0;
                                    @endphp
                                    <li>Name : {{ $order_billing_details->name }}</li>
                                    <li>Email : {{ $order_billing_details->email }}</li>
                                    <li>Division : {{ Division::find($order_billing_details->division)->name }}</li>
                                    <li>District : {{ District::find($order_billing_details->district)->name }}</li>
                                    <li>Address : {{ $order_billing_details->address }}</li>
                                    <li>Zip Code : {{ $order_billing_details->zip_code }}</li>
                                    <li>Phone : {{ $order_billing_details->phone }}</li>
                                </ul>
                            </td>
                            <td class="text-left">
                                <ul>
                                    @foreach ($orders as $order)
                                    <li>{{ Product::find($order->product_id)->name }}  X  {{ $order->quantity }}</li>
                                     @php
                                        if (Product::find($order->product_id)->discount) {
                                        $price = Product::find($order->product_id)->price-Product::find($order->product_id)->discount*Product::find($order->product_id)->price/100;
                                            }
                                        else {
                                            $price = Product::find($order->product_id)->price;
                                        }

                                        $total +=  $price*$order->quantity;
                                    @endphp
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-left">
                                <ul>
                                    @if($item->cupon_id != 0)
                                        <li>Cupon Code : <span class="badge badge-info">{{ Cupon::find($item->cupon_id)->code }}</span></li>
                                    @endif
                                        <li>Total : {{ $total }}</li>
                                </ul>
                            </td>

                            <td class="text-left">
                                <ul>
                                    <li>Payment Status :
                                        @if ($item->payment_status == 1)
                                        <span class="badge badge-danger">Pandding</span>
                                        @else
                                        <span class="badge badge-success">Complete</span>
                                        @endif
                                    </li>

                                    <li>Dalivary Status :
                                        @if ($item->dalivary_status == 1)
                                        <span class="badge badge-danger">Pandding</span>
                                        @elseif($item->dalivary_status == 2)
                                        <span class="badge badge-warning">Prossesing</span>
                                        @else
                                        <span class="badge badge-success">Complete</span>
                                        @endif
                                    </li>

                                    <li>Payment Method :
                                        @if ($item->payment_method == 1)
                                        <span class="badge badge-primary">Cash On Dalyvary</span>
                                        @else
                                        <span class="badge badge-success">Online Tranjection</span>
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
                                    </li>
                                </ul>
                            </td>

                        </tr>
                      @empty
                        <tr colspan="50">
                            <td colspan="15" class="text-danger">No Data to Show</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
            {{ $order_details->links() }}
        </div>

        <div class="card-footer bg-primary ">
            <h5>Total order: {{ $order_details_count }}</h5>
        </div>
    </div>
@endsection
