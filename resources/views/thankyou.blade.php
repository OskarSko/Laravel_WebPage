@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
<div class="text-center mt-5">
    <h1 class="display-4">Thank You for Your Purchase!</h1>
    <p class="lead">Your order has been successfully placed.</p>

    <h3>Order Details:</h3>
    <ul class="list-group mt-4">
        @foreach ($order->items as $item)
            <li class="list-group-item">
                {{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}
            </li>
        @endforeach
    </ul>

    <p class="mt-4"><strong>Total Price:</strong> ${{ $order->total_price }}</p>

    <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-4">Back to Home</a>
</div>
@endsection
