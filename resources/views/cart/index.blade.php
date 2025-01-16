@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<div class="container">
    <h1 class="my-4">Your Cart</h1>

    @if ($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>{{ $cartItem->quantity }}</td>
                        <td>${{ $cartItem->product->price }}</td>
                        <td>${{ $cartItem->product->price * $cartItem->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.remove', ['cartItem' => $cartItem->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item from your cart?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('cart.checkout.address') }}" class="btn btn-success">Checkout</a>
        </div>
    @endif
</div>
@endsection
