@extends('layouts.dashboard')

@section('mainbar')
    <div class="main">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h2>{{__('Product Lis')}}</h2>
                    <a class="btn btn-secondary" href="{{ url('dashboard/products/create') }}">
                        {{__('Create new product')}}
                    </a>
                </div>
            </div>
            <div class="card-body">
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
                        <th scope="col">
                            {{__('Description')}}
                        </th>
                        <th>
                            {{__('Action')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>
                                <img class="mb-3" src="{{ url('public/images/'.$product->image)}}" style="width: 100px; height:100px;">
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->description}}</td>
                            <td>
                                <a href="{{url('dashboard/products/'.$product->id)}}">
                                    {{__('Edit')}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

