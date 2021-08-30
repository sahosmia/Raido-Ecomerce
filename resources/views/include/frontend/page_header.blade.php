<div class="page-header"
    style="background-image: url('{{ asset('frontend/images/shop/page-header-back.jpg') }}'); background-color: #3C63A4;">
    <h1 class="page-title">{{ $name }}</h1>
    <ul class="breadcrumb">
        <li><a href="{{ route('front') }}"><i class="d-icon-home"></i></a></li>
        <li class="delimiter">/</li>
        <li>{{ $name }}</li>
    </ul>
</div>
