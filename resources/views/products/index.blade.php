@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Product List</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-warning">No products found!</div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="text-muted">${{ number_format($product->price, 2) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
