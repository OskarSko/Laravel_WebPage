@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <h1>Order #{{ $order->id }}</h1>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}</li>
        @endforeach
    </ul>
    <p><strong>Total Price:</strong> ${{ $order->total_price }}</p>
    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Back to Profile</a>
@endsection
