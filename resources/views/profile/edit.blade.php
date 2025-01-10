@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <h1>Profile</h1>

    <!-- User Information -->
    <div class="mb-4">
        <h3>User Information</h3>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <!-- Change Password -->
    <div class="mb-4">
        <h3>Change Password</h3>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="mb-4">
        <h3>Delete Account</h3>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </form>
    </div>

    <!-- Purchase History -->
    <div class="mb-4">
        <h3>Purchase History</h3>
        @forelse ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Order #{{ $order->id }}</h5>
                    <p><strong>Total:</strong> ${{ $order->total_price }}</p>

                    <!-- Button to view order details -->
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        @empty
            <p>No purchases yet.</p>
        @endforelse
    </div>
@endsection
