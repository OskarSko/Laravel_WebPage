@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
    <h1 class="my-4">{{ $product->name }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Description:</strong> {{ $product->description}}</p>
            <p><strong>Price:</strong> {{ $product->price}}</p>
            <p><strong>Stock:</strong> {{ $product->stock}}</p>
        </div>
    </div>

    <form action="{{ route('products.buy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Buy Now</button>
                    </form>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
</div>
@endsection
