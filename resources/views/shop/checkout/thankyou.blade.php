@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
<div class="container text-center">
    <h1 class="my-4">Thank You for Your Order!</h1>

    @if ($order)
        <p>Your order ID is: <strong>{{ $order->id }}</strong></p>
        <p>Total Price: <strong>${{ $order->total_price }}</strong></p>
        <p>Payment Method: <strong>{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method ?? 'N/A')) }}</strong></p>
        <p>Payment Status: <strong>{{ ucfirst($order->payment->status ?? 'N/A') }}</strong></p>
        <p>Payment Amount: <strong>${{ $order->payment->amount ?? 'N/A' }}</strong></p>

        <h3 class="mt-4">Order Details:</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No order found.</p>
    @endif

    <a href="{{ route('home') }}" class="btn btn-primary">Back to Shop</a>
</div>
@endsection
