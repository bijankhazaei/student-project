@extends('layouts.dashboard')

@section('mainbar')
    <div class="main">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2>
                    {{__('Create Product')}}
                </h2>
                <a href="{{ url('dashboard/products')}}" class="btn btn-secondary">
                    {{__('Back to List')}}
                </a>
            </div>
            <form class="form" method="post" action="{{ route('dashboard.products.store')}}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">{{__('Product Name')}}</label>
                        <input type="text" class="form-control" id="name" placeholder="Product Name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">{{__('Price')}}</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">{{__('Quantity')}}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" min="1" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">{{__('Description')}}</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <laba for="image">
                            {{__('Image')}}
                        </laba>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        {{__('Create')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

