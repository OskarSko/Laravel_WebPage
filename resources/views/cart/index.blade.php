@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<h1>Your Shopping Cart</h1>

<!-- Sprawdzanie, czy koszyk nie jest pusty -->
@if ($cartItems->isEmpty())
    <p>Your cart is empty!</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
@else
    <!-- Tabela produktów w koszyku -->
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->product->price }}</td>
                    <td>${{ $item->product->price * $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Suma całkowita koszyka -->
    <p><strong>Total Price:</strong> ${{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }}</p>

    <!-- Przycisk Checkout -->
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Checkout</button>
    </form>

    <!-- Link powrotu do sklepu -->
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
@endif
@endsection
