@extends('profile.layout')

@section('profile-content')
<h3>Your Orders</h3>
@forelse ($orders as $order)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Order #{{ $order->id }}</h5>
            <p><strong>Total:</strong> ${{ $order->total_price }}</p>
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@empty
    <p>No orders found.</p>
@endforelse
@endsection
