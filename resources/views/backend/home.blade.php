@extends('layouts.backend')

{{-- nav active satatus --}}
@section('dashboard')
    active
@endsection

{{-- nav active satatus --}}
@section('page_title')
    Dasboard
@endsection

@section('content')



<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title mb-2">Report</h6>
                    <div class="dropdown">
                        <a href="#" class="btn btn-floating" data-toggle="dropdown">
                            <i class="ti-more-alt"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Stats</h5>
                                <div>Last month targets</div>
                            </div>
                            <h3 class="text-success mb-0">$1,23M</h3>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Payments</h5>
                                <div>Week's expenses</div>
                            </div>
                            <div>
                                <h3 class="text-danger mb-0">- $58,90</h3>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Orders</h5>
                                <div>Total products ordered</div>
                            </div>
                            <div>
                                <h3 class="text-info mb-0">65</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="#" class="btn btn-info">Report Detail</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title mb-2">Statistics</h6>
                    <div class="dropdown">
                        <a href="#" class="btn btn-floating" data-toggle="dropdown">
                            <i class="ti-more-alt"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Reports</h5>
                                <div>Monthly sales reports</div>
                            </div>
                            <h3 class="text-primary mb-0">421</h3>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>User</h5>
                                <div>Visitors last week</div>
                            </div>
                            <div>
                                <h3 class="text-success mb-0">+10</h3>
                            </div>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5>Sales</h5>
                                <div>Total average weekly report</div>
                            </div>
                            <div>
                                <h3 class="text-primary mb-0">140</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="#" class="btn btn-warning">Statistics Detail</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title mb-2 text-center">Financial year</h6>
                <p class="mb-0 text-muted">Expenses statistics to date</p>
                <hr>
                <div class="font-size-40 font-weight-bold">$502,680</div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Current month</p>
                        <div>
                            <span class="font-weight-bold">$46,362</span>
                            <span class="badge bg-danger-bright text-danger ml-1">-8%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Last year</p>
                        <div>
                            <span class="font-weight-bold">$34,546</span>
                            <span class="badge bg-success-bright text-success ml-1">-13%</span>
                        </div>
                    </div>
                </div>
                <p class="font-weight-bold">Monthly report</p>
                <div id="ecommerce-activity-chart"></div>
            </div>
        </div>
    </div>
</div>




@endsection
