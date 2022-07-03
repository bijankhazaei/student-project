@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb w-50">
                    <li class="breadcrumb-item">
                        <a href="{{url('/')}}">{{__('Shop')}}</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <p class="m-0" style="width: 300px">{{$product->name}}</p>
                    </li>
                </ul>
                @if(Session::has('cart-message'))
                    <p class="alert alert-info">{{ Session::get('cart-message') }}</p>
                @endif
            </div>
            <div class="col-md-6">
                <figure>
                    @if($product->image)
                        <img class="w-100" src="{{url('public/images/'.$product->image)}}" alt="{{$product->name}}">
                    @else
                        <img class="w-100" src="{{url('assets/placeholder.png')}}">
                    @endif
                </figure>
            </div>
            <div class="col-md-6">
                <h1>{{$product->name}}</h1>
                <p>{{$product->description}}</p>
                <form class="form" method="post" action="{{url('add_to_cart/'.$product->id)}}">
                    @csrf
                    <div class="form-group mb-3">
                        <label>
                            {{__('Quantity')}}
                        </label>
                        <input class="form-control w-25" type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}" id="Quantity">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="add_to_cart" class="form-control">
                            {{__('Add To Cart')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
