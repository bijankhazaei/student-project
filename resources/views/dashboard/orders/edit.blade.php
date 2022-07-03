@extends('layouts.dashboard')

@section('mainbar')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{__('User : ')}}{{$order->user->name}}</h2>
                <h2>{{__('Email : ')}}{{$order->user->email}}</h2>
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
                @if(Auth::user()->is_admin)
                    <form class="form" method="POST" action="{{url('dashboard/orders', [$order->id])}}">
                        @csrf
                        <div class="form-group my-3">
                            <label for="status">{{__('Change Status')}}</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" @if($order->status == 1) selected @endif>{{__('Submit')}}</option>
                                <option value="2" @if($order->status == 2) selected @endif>{{__('Confirm')}}</option>
                                <option value="3" @if($order->status == 3) selected @endif>{{__('Delivered')}}</option>
                                <option value="4" @if($order->status == 4) selected @endif>{{__('Canceled')}}</option>
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-end my-3">
                            <button class="btn btn-primary" type="submit" name="submit">{{__('Change Order Status')}}</button>
                        </div>
                    </form>
                @endif
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
