@extends('layouts.dashboard')

@section('mainbar')
    <div class="main">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-start">
                    <h2>{{__('Order Lis')}}</h2>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">
                            {{__('User')}}
                        </th>
                        <th scope="col">
                            {{__('Status')}}
                        </th>
                        <th scope="col">
                            {{__('Total')}}
                        </th>
                        <th>
                            {{__('Action')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{__('Order ID : #').$order->id}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>
                                @switch($order->status)
                                    @case(1)
                                     {{__('Submit')}}
                                    @break
                                    @case(2)
                                    {{__('Confirm')}}
                                    @break
                                    @case(3)
                                    {{__('Delivered')}}
                                    @break
                                    @case(4)
                                    {{__('Canceled')}}
                                    @break
                                @endswitch
                            </td>
                            <td>{{$order->total}}</td>
                            <td>
                                <a href="{{url('dashboard/orders/'.$order->id)}}">
                                    <i class="fas fa-eye text-secondary"></i>
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


