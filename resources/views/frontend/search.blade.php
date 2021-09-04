

@extends('layouts.frontend')
@section('content')
<div class="container mt-10 mb-10 m-auto">
    <div class="row">
        <section class="pt-3 mt-10">
            <div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4" data-owl-options="{
                    'items': 5,
                    'nav': false,
                    'loop': false,
                    'dots': true,
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        },
                        '992': {
                            'items': 4,
                            'dots': false,
                            'nav': true
                        }
                    }
                }">
                @include('include.frontend.product_item', [
                    'items' => $products,
                ])
            </div>
        </section>
    </div>
</div>
@endsection














































