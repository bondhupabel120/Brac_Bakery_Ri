@extends('layout.main')

@section('content')

<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Menu</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Menu</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Menu Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Menu & Pricing</h4>
                <h1 class="display-4">Competitive Pricing</h1>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="mb-5">{{$product->rcategory ? $product->rcategory->name : ''}}</h1>
                    
                    <div class="row align-items-center mb-5">
                        <div class="col-4 col-sm-3">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ asset ($product->image)}}" alt="">
                            <h5 class="menu-price">${{intval($product->sale_price)}}</h5>
                        </div>
                        <div class="col-8 col-sm-9">
                            <h4>{{$product->name}}</h4>
                            @if (Auth::check())
                                <a href="{{ route('add_to_cart',['id'=>$product->id]) }}" class="btn btn-info">Add to Cart</a>
                            @else
                                <a href="{{ url('login') }}" class="btn btn-info">Add to Cart</a>
                            @endif
                            <p class="m-0 pt-2">{{strip_tags(html_entity_decode($product->description))}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row gap-2">
                        <img class="img-thumbnail" src="{{asset($product->image1)}}" alt="">
                        <img class="img-thumbnail" src="{{asset($product->image2)}}" alt="">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Menu End -->



@endsection