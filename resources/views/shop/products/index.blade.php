@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container">
    <div class="row">
        <!-- Lista kategorii -->
        <div class="col-md-3">
            <h5>Categories</h5>
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item">
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
                                    <!-- Przycisk szczegółów -->
                                    <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-info mb-2">Details</a>

                                    <!-- Formularz zakupu -->
                                    <form action="{{ route('products.buy', ['product' => $product->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mb-2">Buy</button>
                                    </form>

                                    <!-- Formularz dodania do koszyka -->
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
        </div>
    </div>
</div>
@endsection
