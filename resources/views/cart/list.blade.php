@extends('layouts.app')

@section('content')
    <div id="cartList" class="container">
        <div class="card">
            <div class="card-header">
                <h1>{{__('Cart Items')}}</h1>
            </div>
            <div class="card-body">
                @if(count($cartArray) == 0)
                    <h2 class="alert alert-info">
                        {{__('Cart is Empty')}}
                    </h2>
                @else
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
                            <th>
                                {{__('Action')}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartArray as $item)
                            <tr>
                                <th scope="row">{{$item['id']}}</th>
                                <td>
                                    <img class="mb-3" src="{{ url('public/images/'.$item['image'])}}" style="width: 100px; height:100px;">
                                </td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['price']}}</td>
                                <td>{{$item['quantity']}}</td>
                                <td>
                                    <a href="{{url('remove_from_cart/'.$item['id'])}}">
                                        <i class="fas fa-delete-left"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @if ($total > 0)
                <div class="card-footer d-flex justify-content-end align-items-center">
                    <h6 class="mx-4 mb-0">
                        {{__('Total Price: ')}} <strong>{{$total}}</strong>
                    </h6>
                    <a href="{{url('checkout')}}" class="btn btn-success">
                        {{__('Checkout')}}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
