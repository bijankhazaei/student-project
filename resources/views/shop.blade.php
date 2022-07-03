@extends('layouts.app')

@section('content')
    <div id="mainPage" class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <figure id="mainSlide">
                    <img src="{{url('assets/slide.jpg')}}">
                </figure>
            </div>
            <div class="col-md-12">
                <h2 class="text-center fs-1 fw-bolder my-4">
                    {{__(' My Products')}}
                </h2>
            </div>
            @foreach($products as $product)
                <div class="col-md-4 mb-5">
                    <figure class="product-image">
                        @if($product->image)
                            <img src="{{url('public/images/'.$product->image)}}">
                        @else
                            <img src="{{url('assets/placeholder.png')}}">
                        @endif
                    </figure>
                    <h4 class="text-black fw-bold my-3">{{$product->name}}</h4>
                    <h4 class="text-black fw-bold">{{$product->price}}</h4>
                    <a href="{{url('product', [$product->id])}}"
                       class="link-info text-decoration-none fw-bold text-center">
                        {{__('Buy Product')}}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
