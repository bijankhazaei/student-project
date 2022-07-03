@extends('layouts.app')

@section('content')
    <div id="cartList" class="container">
        @if(Session::has('order-submitted'))
            <p class="alert alert-info">{{ Session::get('order-submitted') }}</p>
        @endif
        <div class="card">
            <div class="card-header">
                <h2>{{__('Order Submit successfully')}}</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    @switch($order->status)
                        @case(1)
                        <p class="m-0 fw-bolder">Order Status : {{__('Submit')}}</p>
                        @break
                        @case(2)
                        <p class="m-0 fw-bolder">Order Status : {{__('Confirm')}}</p>
                        @break
                        @case(3)
                        <p class="m-0 fw-bolder">Order Status : {{__('Delivered')}}</p>
                        @break
                        @case(4)
                        <p class="m-0 fw-bolder">Order Status : {{__('Canceled')}}</p>
                        @break
                    @endswitch
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">
                            {{__('Image')}}
                        </th>
                        <th scope="col">
                            {{__('Name')}}
                        </th>
                        <th scope="col">
                            {{__('Price')}}
                        </th>
                        <th scope="col">
                            {{__('Quantity')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                <figure class="product-image" style="width:150px">
                                    @if($product->image)
                                        <img class="w-100" src="{{url('public/images/'.$product->image)}}">
                                    @else
                                        <img class="w-100" src="{{url('assets/placeholder.png')}}">
                                    @endif
                                </figure>
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->pivot->price}}</td>
                            <td>{{$product->pivot->quantity}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{__('Total')}}</td>
                        <td>{{$order->total}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
