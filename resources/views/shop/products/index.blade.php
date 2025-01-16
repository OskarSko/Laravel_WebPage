@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container">
    <div class="row">
        <!-- Lista kategorii -->
        <div class="col-md-3">
            <h5>Categories</h5>
            <ul class="list-group">
            <a href="{{ route('products.index') }}">All Products</a>
                @foreach ($categories as $category)
                    <li class="list-group-item {{ request('category') == $category->id ? 'active' : '' }}">
                        <a href="{{ route('products.index', ['category' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Lista produktów -->
        <div class="col-md-9">
            <h1 class="my-4">Products</h1>

            <!-- Formularz wyszukiwania -->
            <form method="GET" action="{{ route('products.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search products by name..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            @if ($products->isEmpty())
                <p>No products found for this category.</p>
            @else
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p><strong>Price:</strong> ${{ $product->price }}</p>
                                        <p><strong>Stock:</strong> {{ $product->stock }}</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-info mb-2">Details</a>
                                        <form action="{{ route('products.buy', ['product' => $product->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary mb-2">Buy</button>
                                        </form>
                                        <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
