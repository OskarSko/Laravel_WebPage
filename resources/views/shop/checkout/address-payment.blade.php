@extends('layouts.app')

@section('title', 'Checkout - Address & Payment')

@section('content')
<div class="container">
    <h1 class="my-4">Checkout</h1>

    <form action="{{ route('cart.process.payment') }}" method="POST">
        @csrf

        <!-- Wybór adresu -->
        <h3>Select Address</h3>
        @forelse ($addresses as $address)
            <div class="form-check">
                <input type="radio" name="address_id" id="address-{{ $address->id }}" value="{{ $address->id }}" class="form-check-input" required>
                <label for="address-{{ $address->id }}" class="form-check-label">
                    {{ $address->address_line }}, {{ $address->city }}, {{ $address->postal_code }}
                </label>
            </div>
        @empty
            <p>No addresses available. Please <a href="{{ route('profile.data') }}">add an address</a>.</p>
        @endforelse

        <!-- Wybór metody płatności -->
        <h3 class="mt-4">Select Payment Method</h3>
        @foreach ($paymentMethods as $key => $method)
            <div class="form-check">
                <input type="radio" name="payment_method" id="payment-{{ $key }}" value="{{ $key }}" class="form-check-input" required>
                <label for="payment-{{ $key }}" class="form-check-label">
                    {{ $method }}
                </label>
            </div>
        @endforeach

        <!-- Przycisk zapłać -->
        <button type="submit" class="btn btn-success mt-4">Pay</button>
    </form>
</div>
@endsection
