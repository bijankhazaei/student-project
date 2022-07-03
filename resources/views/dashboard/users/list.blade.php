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
                            {{__('Name')}}
                        </th>
                        <th scope="col">
                            {{__('Email')}}
                        </th>
                        <th>
                            {{__('Action')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{__('Order ID : #').$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @switch($user->is_admin)
                                    @case(0)
                                    {{__('Client')}}
                                    @break
                                    @case(1)
                                    {{__('Admin')}}
                                    @break
                                @endswitch
                            </td>
                            <td>
                                <a href="{{url('dashboard/users', [$user->id])}}">
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


